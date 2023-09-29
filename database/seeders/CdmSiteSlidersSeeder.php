<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Storage;

class CdmSiteSlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = new \App\CustomModels\CusModel_Sliders();
        $sliders->is_from_seeds = true;
        $sliders->save();
    }
}
