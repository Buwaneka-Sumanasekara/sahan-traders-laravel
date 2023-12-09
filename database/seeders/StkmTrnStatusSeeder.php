<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StkmTrnStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ar_status = [
            ["id" => config('global.stk_trn_status.pending'), "name" => "Pending", "active" => true],
            ["id" => config('global.stk_trn_status.processed'), "name" => "Processed", "active" => true],
            ["id" => config('global.stk_trn_status.hold'), "name" => "Hold", "active" => true],
            ["id" => config('global.stk_trn_status.cancelled'), "name" => "Cancelled", "active" => true],
        ];

        foreach ($ar_status as $status) {
            \App\Models\StkmTrnStatus::create($status);
        }
    }
}
