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
        $ar_sliders = [
            [
                'id' => 1,
                'title' => 'Home Slider',
                'subtitle' => 'Home Slider',
                'order' => 1,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'img_path' => 'slider_1.jpg',
            ],
            [
                'id' => 2,
                'title' => 'Home Slider',
                'subtitle' => 'Home Slider',
                'order' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'img_path' => 'slider_2.jpg',
            ],
            [
                'id' => 3,
                'title' => 'Home Slider',
                'subtitle' => 'Home Slider',
                'order' => 3,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'img_path' => 'slider_3.jpg',
            ]
        ];


        //copy images
        $files = FileFacade::files(public_path('img_defaults/sliders'));
        foreach ($files as $file) {
            $filename = public_path('img_defaults/sliders/') . $file->getFilename();
            if (!Storage::disk('local')->exists('public/images/sliders/' . $file->getFilename())) {
                Storage::putFileAs('public/images/sliders', new File($filename), $file->getFilename());
            }
        }

        foreach ($ar_sliders as $slider) {
            \App\Models\CdmSiteSliders::create($slider);
        }
    }
}
