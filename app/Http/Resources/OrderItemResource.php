<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Resource representation of an OrderItem.
 */
class OrderItemResource extends JsonResource
{
    /**
     * Transform the order item into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product'  => $this->product->name,
            'price'    => $this->price,
            'quantity' => $this->quantity,
        ];
    }
}
