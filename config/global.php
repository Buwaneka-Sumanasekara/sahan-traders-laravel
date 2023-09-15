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

];
