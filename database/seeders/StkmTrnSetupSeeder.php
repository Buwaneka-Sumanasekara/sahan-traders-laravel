<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StkmTrnSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ar_items = [
            [
                "id" => config("global.trn_setup_id.cart"),
                "type" => config('global.trn_setup_types.Cart'),
                "name" => "Cart transaction",
                "mode" => -1,
                "en_cprice" => false,
                "en_sprice" => true,
                "en_payment" => true,
                "cal_mode" => config("global.cal_mode.sell_price"),
                "en_line_dis_per" => true,
                "en_line_dis_amt" => true,
                "en_display" => false,
                "en_check_qty" => false
            ],
        ];

        foreach ($ar_items as $item) {
            \App\Models\StkmTrnSetup::create($item);
        }
    }
}
