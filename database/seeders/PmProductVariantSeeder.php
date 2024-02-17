<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PmProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $ar_variant_group = [
            ["id" => 0, "name" => "Default", "active" => true, "type_id" => config("global.variant_group_type.default")],
            ["id" => 1, "name" => "Color", "active" => true,"type_id"=>config("global.variant_group_type.color")],
        ];
        foreach ($ar_variant_group as $variant_group) {
            \App\Models\PmProductVariantGroup::create($variant_group);
        }

        $ar_variants = [
            //Text
            ["id" => 0, "name" => "", "active" => true,"val"=>"","variant_group_id"=>0],
            
            //Colors
            ["id" => 1, "name" => "Red", "active" => true,"val"=>"#FF0000","variant_group_id"=>1],
            ["id" => 2, "name" => "Blue", "active" => true,"val"=>"#0000FF","variant_group_id"=>1],
            ["id" => 3, "name" => "Orange", "active" => true,"val"=>"#FFA500","variant_group_id"=>1],
        ];
        foreach ($ar_variants as $variant) {
            \App\Models\PmProductVariant::create($variant);
        }

    }
}
