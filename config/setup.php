<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Setup Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for setup configuration
    |
    */

    //Site  settings

    'en_batch' => env('COMMON_SETUP_EN_BATCH', false),
    'tax_per' => env('COMMON_SETUP_TAX_PER', 10),
    'en_tax' => env('COMMON_SETUP_TAX_PER', true),
    'en_auto_add_stock' => env('COMMON_SETUP_AUTO_ADD_STOCK', true),

    'product_group1_name' => env('COMMON_SETUP_PRODUCT_GROUP1_NAME', 'Category'),
    'product_group2_name' => env('COMMON_SETUP_PRODUCT_GROUP2_NAME', 'Sub Category'),
    'product_group3_name' => env('COMMON_SETUP_PRODUCT_GROUP3_NAME', 'Type'),
    'product_group4_name' => env('COMMON_SETUP_PRODUCT_GROUP4_NAME', 'Brand'),
    'product_group5_name' => env('COMMON_SETUP_PRODUCT_GROUP5_NAME', 'Condition'),


    'base_currency_id' => env('COMMON_SETUP_BASE_CUR_ID', "YEN"), //this will use for transactions
    'base_currency_name' => env('COMMON_SETUP_BASE_CUR_NAME', "Yen"),
    'base_currency_symbol' => env('COMMON_SETUP_BASE_CUR_SYMBOL', "¥"),
    'base_country_id' => env('COMMON_SETUP_BASE_COUNTRY_ID', "JPY"),




];
