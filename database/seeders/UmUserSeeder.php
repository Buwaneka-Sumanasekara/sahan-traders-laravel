<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            ],
            [
                "id" => 1,
                "first_name" => "Buwaneka",
                "last_name" => "Sumanasekara",
                "email" => "buwanekasumanasekara@gmail.com",
                "um_user_status_id" => config("global.user_status_active"),
                "um_user_role_id" => config("global.user_role_buyer")
            ]
        ];


        foreach ($ar_users as $user) {
            \App\Models\UmUser::updateOrCreate([
                'id' => $user['id']
            ], $user);

            $user_login = [
                "um_user_id" => $user['id'],
                "username" => $user['email'],
                "password" => Hash::make('123'),
                "um_user_id" => $user['id'],
                "email_verified" => true,
                "email_verified_at" => now()
            ];
            \App\Models\SmUserLogin::updateOrCreate([
                'username' => $user_login['username']
            ], $user_login);


            if ($user['um_user_role_id'] === config("global.user_role_buyer")) {
                //TODO: add buyer 
            }
        }
    }
}
