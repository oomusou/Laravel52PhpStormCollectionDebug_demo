<?php

use App\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OrderServiceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function SQLiteInMemory連線()
    {
        /** arrange */
        $expected = 0;

        /** act */
        $actual = Order::all();

        /** assert */
        $this->assertCount($expected, $actual);
    }

    /** @test */
    public function 今天全部訂單金額()
    {
        /** Arrange */
        Carbon::setTestNow(Carbon::create(2016, 6, 18));

        Order::create([
            'order_date' => Carbon::create(2016, 6, 17),
            'quantity'   => 1,
            'price'      => 100
        ]);

        Order::create([
            'order_date' => Carbon::create(2016, 6, 18),
            'quantity'   => 2,
            'price'      => 200
        ]);

        Order::create([
            'order_date' => Carbon::create(2016, 6, 18),
            'quantity'   => 3,
            'price'      => 300
        ]);

        $expected = 1300;

        /** Act */
        $actual = app(OrderService::class)->calculateTodayTotalAmount();

        /** Assert */
        $this->assertEquals($expected, $actual);
    }
}


