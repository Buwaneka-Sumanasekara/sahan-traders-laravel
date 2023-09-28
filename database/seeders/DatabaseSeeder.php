<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\UmUserRole;
use App\Models\UmUserStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CdmSiteSlidersSeeder::class);
        $this->call(UmUserRoleSeeder::class);
        $this->call(UmUserStatusSeeder::class);
        $this->call(SmPermissionsSeeder::class);
        $this->call(UmUserRoleHasSmPermissionsSeeder::class);
        $this->call(UmUserSeeder::class);
        $this->call(PmUnitSeeder::class);
        $this->call(PmGroupSeeder::class);
        $this->call(PmProductSeeder::class);
    }
}
