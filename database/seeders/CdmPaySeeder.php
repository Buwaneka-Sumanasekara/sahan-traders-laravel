<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CdmPaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ar_pay_hed= [
            ["id" => config("global.payment_hed_type.stripe"), "name" => config("global.payment_hed_type.stripe"), "has_det"=>true,"en_front"=>true,"en_back"=>false,"over_pay"=>false,"is_adv_pay"=>false],
        ];

        foreach ($ar_pay_hed as $pay_hed) {
            \App\Models\CdmPayHed::create($pay_hed);
        }


        $ar_pay_det= [
            ["id" => config("global.payment_det_type.online"), "name" => config("global.payment_det_type.online"), "active"=>true,"cdm_pay_hed_id"=>config("global.payment_hed_type.stripe")]
        ];

        foreach ($ar_pay_det as $pay_det) {
            \App\Models\CdmPayDet::create($pay_det);
        }


    }
}
