<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * API controller for product CRUD operations.
 */
class ProductController extends Controller
{

    public function __construct(private ProductService $productService)
    {
    }

    /**
     * Display a paginated listing of products.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection(
            Product::paginate(10)
        );
    }

    /**
     * Store a newly created product.
     *
     * @param  \App\Http\Requests\Product\StoreProductRequest  $request
     * @return \App\Http\Resources\ProductResource
     */
    public function store(StoreProductRequest $request): ProductResource
    {
        $this->authorize('create', $request);

        $product = $this->productService->create($request->validated());

        return new ProductResource($product);
    }

    /**
     * Update the specified product.
     *
     * @param  \App\Http\Requests\Product\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \App\Http\Resources\ProductResource
     */
    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $this->authorize('update', $product);

        $product = $this->productService->update($product, $request->validated());

        return new ProductResource($product);
    }

    /**
     * Remove the specified product (soft delete).
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->authorize('delete', $product);

        $this->productService->delete($product);

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }

    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \App\Http\Resources\ProductResource
     */
    public function show(Product $product): ProductResource
    {
        $this->authorize('view', $product);

        return new ProductResource($product);
    }
}
