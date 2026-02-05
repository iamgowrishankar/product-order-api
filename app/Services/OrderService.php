<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OrderService
{
    public function createOrder($user, array $data): Order
    {
        return DB::transaction(function () use ($user, $data) {

            $total = 0;
            $items = [];

            foreach ($data['items'] as $item) {
                $product = Product::lockForUpdate()->find($item['product_id']);

                if (! $product || $product->status !== 'active') {
                    throw new BadRequestHttpException('Product is inactive or not found');
                }

                if ($product->stock_quantity < $item['quantity']) {
                    throw new BadRequestHttpException(
                        "Insufficient stock for product {$product->name}"
                    );
                }

                $product->decrement('stock_quantity', $item['quantity']);

                $lineTotal = $product->price * $item['quantity'];
                $total += $lineTotal;

                $items[] = [
                    'product_id' => $product->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $product->price,
                ];
            }

            $order = Order::create([
                'user_id'      => $user->id,
                'order_number' => strtoupper(Str::uuid()),
                'total_amount' => $total,
                'status'       => 'pending',
            ]);

            foreach ($items as $item) {
                $order->items()->create($item);
            }

            return $order->load('items.product');
        });
    }
}

