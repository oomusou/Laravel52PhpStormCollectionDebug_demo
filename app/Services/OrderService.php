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
        $totalAmount = 0;

        $orders = $this->order->all();
        foreach($orders as $order) {
            if ($order->order_date == Carbon::now()) {
                $totalAmount = $totalAmount + $order->quantity * $order->price;
            }
        }

        return $totalAmount;
    }
}