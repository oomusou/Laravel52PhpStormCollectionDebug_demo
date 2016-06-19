<?php

namespace App\Services;

use App\Order;
use Carbon\Carbon;

class OrderService
{
    /** @var Order */
    private $order;

    /**
     * OrderService constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * 計算今天全部訂單金額
     * @return int
     */
    public function calculateTodayTotalAmount() : int
    {
        return $this->order->all()
            ->filter(function ($value) {
                return $value->order_date == Carbon::now();
            })
            ->map(function ($value) {
                return $value->quantity * $value->price;
            })
            ->reduce(function ($carry, $value) {
                return $carry + $value;
            });
    }
}