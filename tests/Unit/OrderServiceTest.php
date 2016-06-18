<?php

use App\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OrderServiceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function SQLiteInMermoy連線()
    {
        /** arrange */
        $expected = 0;

        /** act */
        $actual = Order::all();

        /** assert */
        $this->assertCount($expected, $actual);
    }
}


