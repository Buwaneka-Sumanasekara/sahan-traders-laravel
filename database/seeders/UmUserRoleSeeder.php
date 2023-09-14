<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UmUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ar_user_roles = [
            ["id" => config("global.user_role_admin"), "name" => "Administrator", "active" => true],
            ["id" => config("global.user_role_buyer"), "name" => "Buyer", "active" => true]
        ];

        foreach ($ar_user_roles as $user_role) {
            \App\Models\UmUserRole::create($user_role);
        }
    }
}
