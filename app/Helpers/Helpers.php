<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Number;

if (!function_exists('convertToDisplayPrice')) {
    /**
     * This function uploads files to the filesystem of your choice
     * @param \Illuminate\Http\UploadedFile $file The File to Upload
     * @param string|null $filename The file name
     * @param string|null $folder A specific folder where the file will be stored
     * @param string $disk Your preferred Storage location(s3,public,gcs etc)
     */

    function convertToDisplayPrice($price)
    {
        if($price){
            return  Number::currency($price, config("setup.base_country_id"));
        }else{
            return Number::currency(0, config("setup.base_country_id"));
        }
    }
}
