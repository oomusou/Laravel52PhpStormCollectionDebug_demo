<?php

namespace App\Services;

use App\Order;
use Carbon\Carbon;
use Closure;

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
            ->filter($this->filterToToday())
            ->map($this->mapToAmount())
            ->reduce($this->reduceToTotalAmount());
    }

    /**
     * 只有今天的訂單
     * @return Closure
     */
    private function filterToToday()
    {
        return function ($value) {
            return $value->order_date == Carbon::now();
        };
    }

    /**
     * 換算成金額
     * @return Closure
     */
    private function mapToAmount()
    {
        return function ($value) {
            return $value->quantity * $value->price;
        };
    }

    /**
     * 換算成總金額
     * @return Closure
     */
    private function reduceToTotalAmount()
    {
        return function ($carry, $value) {
            return $carry + $value;
        };
    }
}