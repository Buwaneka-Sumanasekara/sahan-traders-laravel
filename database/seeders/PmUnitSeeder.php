<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PmUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ar_units = [
            ["id" => 0, "name" => "NOS", 'symbol' => '', "active" => true],
        ];

        foreach ($ar_units as $unit) {
            \App\Models\PmUnit::create($unit);
        }


        //unit groups
        $ar_unit_groups = [
            ["id" => 0, "name" => "Number of items", "active" => true],
        ];
        foreach ($ar_unit_groups as $unit_group) {
            \App\Models\PmUnitGroup::create($unit_group);
        }


        //unit of groups mapping

        $ar_unit_unit_groups = [
            [
                'pm_unit_id' => 0,
                'pm_unit_group_id' => 0,
                'volume' => 1,
                'is_base' => true,
                'is_sales_unit' => true,
                'is_purchase_unit' => true,
                'active' => true,
            ]
        ];

        foreach ($ar_unit_unit_groups as $unit_unit_group) {
            \App\Models\PmUnitHasPmUnitGroup::create($unit_unit_group);
        }
    }
}
