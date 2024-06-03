<?php

namespace Database\Seeders;

use App\Models\CmCartPayStatus;
use App\Models\StkmTrnSetup;
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
        $this->call(CdmCountrySeeder::class);
        $this->call(UmUserRoleSeeder::class);
        $this->call(UmUserStatusSeeder::class);
        $this->call(SmPermissionsSeeder::class);
        $this->call(UmUserRoleHasSmPermissionsSeeder::class);
        $this->call(UmUserSeeder::class);
        $this->call(PmUnitSeeder::class);
        $this->call(PmGroupSeeder::class);
        $this->call(PromoPromotionTypeSeeder::class);
        $this->call(PmProductVariantSeeder::class);
        
        $this->call(PmProductSeeder::class);


        
        $this->call(CmCartStatusSeeder::class);
        $this->call(CmCartPayStatusSeeder::class);

        $this->call(StkmTrnStatusSeeder::class);
        $this->call(StkmTrnSetupSeeder::class);
        $this->call(CdmPaySeeder::class);
    }
}
