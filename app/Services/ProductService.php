<?php

namespace App\Services;

use App\Models\Product;

/**
 * Service handling product-related business logic.
 */
class ProductService
{
    /**
     * Create a new product.
     *
     * @param  array  $data
     * @return \App\Models\Product
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * Update an existing product.
     *
     * @param  \App\Models\Product  $product
     * @param  array  $data
     * @return \App\Models\Product
     */
    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product;
    }

    /**
     * Soft delete a product.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function delete(Product $product): void
    {
        $product->delete();
    }
}
