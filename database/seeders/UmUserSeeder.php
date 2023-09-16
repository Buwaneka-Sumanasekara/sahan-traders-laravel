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
            ]
        ];


        foreach ($ar_users as $ar_user) {
            \App\Models\UmUser::create($ar_user);
        }
    }
}
