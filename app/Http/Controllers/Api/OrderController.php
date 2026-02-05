<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function index()
    {
        $user = request()->user();

        $orders = $user->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return OrderResource::collection($orders);
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->createOrder(
            $request->user(),
            $request->validated()
        );

        return new OrderResource($order);
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        
        return new OrderResource(
            $order->load('items.product')
        );
    }
}
