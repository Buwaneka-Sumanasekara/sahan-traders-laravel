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
    'base_currency_id_stripe' => env('COMMON_SETUP_BASE_CUR_ID_STRIPE', "jpy"), //this will use for stripe
    'base_currency_name' => env('COMMON_SETUP_BASE_CUR_NAME', "Yen"),
    'base_currency_symbol' => env('COMMON_SETUP_BASE_CUR_SYMBOL', "¥"),
    'base_country_id' => env('COMMON_SETUP_BASE_COUNTRY_ID', "JPY"),


    //ship and co
    'ship_and_co_api_key' => env('SHIP_AND_CO_API_KEY', ""),
    'ship_and_co_api_url' => env('SHIP_AND_CO_URL', "https://app.shipandco.com/api/v1"),
    'ship_and_co_api_currency' => env('SHIP_AND_CO_CURRENCY', "JPY"),

    'company_name' => "OSAKA SAHAN INTERNATIONAL TRADERS (PRIVATE) LIMITED",
    'company_phone' => "+818090654212",
    'company_country' => "JP",
    'company_address1' => "909-910-1-3- Koya,",
    'company_address2' => "Sosa City",
    'company_city' => "Chiba",
    'company_province' => "",
    'company_zip' => "289-2135",
    'company_email' => "info@sahantraders.com",
    "company_courier_country_code" => "JP",

    //stripe
    'stripe_key' => env('STRIPE_KEY', ''),
    'stripe_secret' => env('STRIPE_SECRET', ''),

];
