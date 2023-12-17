<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoPromotionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ar = [
            ["id" => config("global.promo_types.discount_amt"), "name" => "Discount amount", "active" => true],
            ["id" => config("global.promo_types.discount_per"), "name" => "Discount percentage", "active" => true],
        ];

        foreach ($ar as $item) {
            \App\Models\PromoPromotionType::create($item);
        }

    }
}
