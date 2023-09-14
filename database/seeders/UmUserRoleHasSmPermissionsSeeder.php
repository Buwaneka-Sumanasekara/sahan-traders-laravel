<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UmUserRoleHasSmPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ar_user_role_has_per = [
            //admin permissions
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00100"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00110"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00111"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00112"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00113"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00114"],

            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00200"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00201"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00202"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00203"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00204"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00205"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00206"],

            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00300"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00301"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00302"],

            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00400"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00401"],
            ["um_user_role_id" => config('global.user_role_admin'), "sm_permissions_id" => "00402"],

            //buyer
            ["um_user_role_id" => config('global.user_role_buyer'), "sm_permissions_id" => "00400"],
            ["um_user_role_id" => config('global.user_role_buyer'), "sm_permissions_id" => "00401"],
            ["um_user_role_id" => config('global.user_role_buyer'), "sm_permissions_id" => "00402"],
        ];

        foreach ($ar_user_role_has_per as $user_role_has_per) {
            \App\Models\UmUserRoleHasSmPermissions::create($user_role_has_per);
        }
    }
}
