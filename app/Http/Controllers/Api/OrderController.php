<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * API controller for order operations (list, create, view).
 */
class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }

    /**
     * List orders for the authenticated user.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $user = request()->user();

        $orders = $user->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return OrderResource::collection($orders);
    }

    /**
     * Create a new order for the authenticated user.
     *
     * @param  \App\Http\Requests\Order\StoreOrderRequest  $request
     * @return \App\Http\Resources\OrderResource
     */
    public function store(StoreOrderRequest $request): OrderResource
    {
        $order = $this->orderService->createOrder(
            $request->user(),
            $request->validated()
        );

        return new OrderResource($order);
    }

    /**
     * Show a specific order (authorization applied).
     *
     * @param  \App\Models\Order  $order
     * @return \App\Http\Resources\OrderResource
     */
    public function show(Order $order): OrderResource
    {
        $this->authorize('view', $order);
        
        return new OrderResource(
            $order->load('items.product')
        );
    }
}
