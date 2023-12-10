<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UmUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ar_users = [
            [
                "id" => 0,
                "first_name" => "Admin",
                "last_name" => "User",
                "email" => "admin@sahantraders.com",
                "um_user_status_id" => config("global.user_status_active"),
                "um_user_role_id" => config("global.user_role_admin"),
                "password" => Hash::make('123'),
                "email_verified" => true,
                "email_verified_at" => now(),
                'remember_token' => Str::random(10),
            ],
            [
                "id" => 1,
                "first_name" => "Buwaneka",
                "last_name" => "Sumanasekara",
                "email" => "buwanekasumanasekara@gmail.com",
                "um_user_status_id" => config("global.user_status_active"),
                "um_user_role_id" => config("global.user_role_buyer"),
                "password" => Hash::make('123'),
                "email_verified" => false,
            ],
            [
                "id" => 2,
                "first_name" => "Sahan",
                "last_name" => "Wije",
                "email" => "sahan.traders.tester@gmail.com",
                "um_user_status_id" => config("global.user_status_active"),
                "um_user_role_id" => config("global.user_role_buyer"),
                "password" => Hash::make('123'),
                "email_verified" => false,
            ],
            [
                "id" => 3,
                "first_name" => "Buyer",
                "last_name" => "(Dif Address)",
                "email" => "sahan.traders.tester+1@gmail.com",
                "um_user_status_id" => config("global.user_status_active"),
                "um_user_role_id" => config("global.user_role_buyer"),
                "password" => Hash::make('123'),
                "email_verified" => false,
            ],
            [
                "id" => 4,
                "first_name" => "Buyer",
                "last_name" => "(No Address)",
                "email" => "sahan.traders.tester+2@gmail.com",
                "um_user_status_id" => config("global.user_status_active"),
                "um_user_role_id" => config("global.user_role_buyer"),
                "password" => Hash::make('123'),
                "email_verified" => false,
            ]
        ];

        $buyerAddress_1 = new \App\Models\BmBuyerAddress();


        $buyerAddress_1->id = 1;
        $buyerAddress_1->address_1 = "No 88/10C";
        $buyerAddress_1->address_2 = "Samidu Lane, Mavithara";
        $buyerAddress_1->city = "Piliyandala";
        $buyerAddress_1->zip_code = "10300";
        $buyerAddress_1->cdm_country_id = 2; //Sri Lanka
        $buyerAddress_1->province_name = "Western";
        $buyerAddress_1->save();

        $buyerAddress_2 = new \App\Models\BmBuyerAddress();
        $buyerAddress_2->id = 2;
        $buyerAddress_2->address_1 = "909-910-1-3";
        $buyerAddress_2->address_2 = "Koya, Sosa City";
        $buyerAddress_2->city = "Chiba";
        $buyerAddress_2->zip_code = "289-2135";
        $buyerAddress_2->cdm_country_id = 1; //Japan
        $buyerAddress_2->province_name = "Chiba";
        $buyerAddress_2->save();




        foreach ($ar_users as $ar_user) {
            \App\Models\UmUser::create($ar_user);
            if ($ar_user["um_user_role_id"] == config("global.user_role_buyer")) {

                $buyer = new \App\Models\BmBuyer();



                if ($ar_user["id"] === 1) {
                    $buyer->address_bill_id = $buyerAddress_1->id;
                    $buyer->address_ship_id = $buyerAddress_1->id;
                } else  if ($ar_user["id"] === 2) {
                    $buyer->address_bill_id = $buyerAddress_2->id;
                    $buyer->address_ship_id = $buyerAddress_2->id;
                } else  if ($ar_user["id"] === 3) {
                    $buyer->address_bill_id = $buyerAddress_1->id;
                    $buyer->address_ship_id = $buyerAddress_2->id;
                }


                $buyer->id = $ar_user["id"];
                $buyer->user_id = $ar_user["id"];
                $buyer->total_orders = 0;
                $buyer->contact_1 = "0771234567";
                $buyer->contact_2 = "0771234567";


                $buyer->save();
            }
        }
    }
}
