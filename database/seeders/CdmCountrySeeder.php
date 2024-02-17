<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CdmCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ar_country = [
            ["id" => 1, "name" => "Japan", "courier_code" => "JP", "payment_code" => "JP", "active" => true],
            ["id" => 2, "name" => "Sri Lanka", "courier_code" => "LK", "payment_code" => "LK", "active" => true],
            ["id" => 3, "name" => "United Arab Emirates", "courier_code" => "AE", "payment_code" => "AE", "active" => true],
            ["id" => 4, "name" => "Portugal", "courier_code" => "PT", "payment_code" => "PT", "active" => true]
        ];

        foreach ($ar_country as $country) {
            \App\Models\CdmCountry::create($country);
        }
    }
}
