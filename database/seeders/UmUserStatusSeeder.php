<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UmUserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ar_user_status = [
            ["id" => config('global.user_status_pending'), "name" => "Pending", "active" => true],
            ["id" => config('global.user_status_active'), "name" => "Active", "active" => true],
            ["id" => config('global.user_status_blocked'), "name" => "Blocked", "active" => true]
        ];

        foreach ($ar_user_status as $user_status) {
            \App\Models\UmUserStatus::create($user_status);
        }
    }
}
