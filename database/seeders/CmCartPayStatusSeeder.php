<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmCartPayStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ar_status = [
            ["id" => config('global.cart_pay_status.pending'), "name" => "Pending", "active" => true],
            ["id" => config('global.cart_pay_status.success'), "name" => "Success", "active" => true],
            ["id" => config('global.cart_pay_status.rejected'), "name" => "Rejected", "active" => true],
        ];

        foreach ($ar_status as $status) {
            \App\Models\CmCartPayStatus::create($status);
        }
    }
}
