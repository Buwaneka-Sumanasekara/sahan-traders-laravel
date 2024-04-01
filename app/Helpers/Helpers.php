<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Number;
use Illuminate\Support\Facades\Http;

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

   

    function getShipAndCoApiHttp()
    {
        $apiKey = config("setup.ship_and_co_api_key");
        $apiUrl = config("setup.ship_and_co_api_url");
        if (!$apiKey) {
            throw new Exception("Ship and Co API Key is not set");
        }
        if (!$apiUrl) {
            throw new Exception("Ship and Co API URL is not set");
        }
        return Http::withHeaders([
            'x-access-token' => $apiKey,
            'Content-Type' => 'application/json',
        ])->baseUrl($apiUrl);
    }

    function convertToDisplayableText($text)
    {
        if ($text) {
            return ucfirst(str_replace("_"," ",$text));
        } else {
            return "";
        }
    }
    function convertToDisplayableCarrier($text)
    {
        if ($text) {
            $str=ucfirst(str_replace("_"," - ",$text));
            return $str;
        } else {
            return "";
        }
    }

    function getValueFromObjectArray($array = [], $key = "id", $keyVal = "")
    {

       // dd($array);
        foreach ($array as $item) {
          // dd($keyVal==$item[$key]);
            if ($item[$key] == $keyVal) {
                return $item;
            }
        }
        return null; // If no matching object found
    }
}
