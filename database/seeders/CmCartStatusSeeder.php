<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmCartStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ar_status = [
            ["id" => config('global.cart_status.pending'), "name" => "Pending", "active" => true],
            ["id" => config('global.cart_status.payment_pending'), "name" => "Payment Pending", "active" => true],
            ["id" => config('global.cart_status.payment_rejected'), "name" => "Payment Rejected", "active" => true],
            ["id" => config('global.cart_status.payment_done'), "name" => "Payment Done", "active" => true],
            ["id" => config('global.cart_status.order_processing'), "name" => "Order Processing", "active" => true],
            ["id" => config('global.cart_status.hand_over_to_delivery'), "name" => "Handover to Delivery", "active" => true],
            ["id" => config('global.cart_status.completed'), "name" => "Completed", "active" => true],
        ];

        foreach ($ar_status as $status) {
            \App\Models\CmCartStatus::create($status);
        }
    }
}
