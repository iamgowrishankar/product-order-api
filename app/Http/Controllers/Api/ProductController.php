<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(private ProductService $productService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(
            Product::paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request->validated());

        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $product = $this->productService->update($product, $request->validated());

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        
        $this->productService->delete($product);

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }

    public function show(Product $product)
    {
        $this->authorize('view', $product);

        return new ProductResource($product);
    }
}
