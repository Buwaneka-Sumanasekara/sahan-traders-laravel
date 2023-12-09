<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Global Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for global configuration
    |
    */

    "product_image_sizes" => [
        "thumbnail" => [
            "width" => 400,
            "height" => 300,
        ],
        "medium" => [
            "width" => 800,
            "height" => 600,
        ],
    ],
    "slider_image_sizes" => [
        "home" => [
            "width" => 1320,
            "height" => 440,
        ],
    ],


    //default user id
    'default_admin_user_id' => 0,

    //default units
    'default_unit_id' => 0,
    'default_unit_group_id' => 0,

    //user status
    'user_status_pending' => 0,
    'user_status_active' => 1,
    'user_status_blocked' => 2,

    //user roles
    'user_role_admin' => 1,
    'user_role_buyer' => 2,

    //session attributes
    'session_user_obj' => "logged_user_object",
    'session_permissions' => "permissions",
    'session_permissions_tabs' => "permissions_tabs",

    //alerts
    'flash_success' => 'alert-success',
    'flash_error' => 'alert-danger',

    //calculation mode
    "cal_mode" => [
        "cost_price" => "C",
        "sell_price" => "S",
    ],
    "cart_status" => [
        "pending" => 0,
        "payment_pending" => 1,
        "payment_rejected" => 2,
        "payment_done" => 3,
        "order_processing" => 4,
        "hand_over_to_delivery" => 5,
        "completed" => 6,
    ],

    "stk_trn_status" => [
        "pending" => 0,
        "processed" => 1,
        "hold" => 2,
        "cancelled" => 3,
    ],
    "cart_pay_status" => [
        "pending" => 0,
        "success" => 1,
        "rejected" => 2,
    ],
    "trn_setup_types" => [
        "Cart" => "CART", //Cart
        "Grn" => "GRN",
        "Return" => "RET",
        "Invoice" => "INV",
    ],
];
