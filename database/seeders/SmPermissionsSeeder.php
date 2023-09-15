<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SmPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ar_permissions = [
            //General
            ["id" => "00001", "name" => "My Account", "parent_id" => "00001", 'tab_name' => 'My Account', 'is_ui' => true, 'url_path' => 'my-account', 'order_no' => 1],
            ["id" => "00002", "name" => "My Orders", "parent_id" => "00001", 'tab_name' => 'My Orders', 'is_ui' => true, 'url_path' => 'my-account/orders', 'order_no' => 2],
            ["id" => "00003", "name" => "My Inquiries", "parent_id" => "00001", 'tab_name' => 'My Inquiries', 'is_ui' => true, 'url_path' => 'my-account/inquiries', 'order_no' => 3],
            ["id" => "00004", "name" => "My Addresses", "parent_id" => "00001", 'tab_name' => 'My Addresses', 'is_ui' => true, 'url_path' => 'my-account/addresses', 'order_no' => 4],


            //Admin
            ["id" => "00100", "name" => "Dashboard", "parent_id" => "00100", 'tab_name' => 'Dashboard', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => '/admin', 'order_no' => 100],


            ["id" => "00110", "name" => "Orders", "parent_id" => "00110", 'tab_name' => 'Orders', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/orders', 'order_no' => 110],
            ["id" => "00111", "name" => "Pending Orders", "parent_id" => "00110", 'tab_name' => 'Pending orders', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/orders/pending', 'order_no' => 111],
            ["id" => "00112", "name" => "Product Inquiries", "parent_id" => "00110", 'tab_name' => 'Product Inquiries', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/orders/inquiries', 'order_no' => 112],
            ["id" => "00113", "name" => "Search Orders", "parent_id" => "00110", 'tab_name' => 'Search orders', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/orders/search', 'order_no' => 113],
            ["id" => "00114", "name" => "Search Inquiries", "parent_id" => "00110", 'tab_name' => 'Search Inquiries', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/orders/inquiries-search', 'order_no' => 114],

            ["id" => "00200", "name" => "Categories", "parent_id" => "00200", 'tab_name' => 'Categories', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/categories', 'order_no' => 200],
            ["id" => "00201", "name" => "Group1", "parent_id" => "00200", 'tab_name' => 'Group1', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/categories/1', 'order_no' => 201],
            ["id" => "00202", "name" => "Group2", "parent_id" => "00200", 'tab_name' => 'Group2', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/categories/2', 'order_no' => 202],
            ["id" => "00203", "name" => "Group3", "parent_id" => "00200", 'tab_name' => 'Group3', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/categories/3', 'order_no' => 203],
            ["id" => "00204", "name" => "Group4", "parent_id" => "00200", 'tab_name' => 'Group4', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/categories/4', 'order_no' => 204],
            ["id" => "00205", "name" => "Group5", "parent_id" => "00200", 'tab_name' => 'Group5', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/categories/5', 'order_no' => 205],
            ["id" => "00206", "name" => "Group Mapping", "parent_id" => "00200", 'tab_name' => 'Mapping', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/categories/map', 'order_no' => 206],

            ["id" => "00300", "name" => "Products", "parent_id" => "00300", 'tab_name' => 'Products', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/products', 'order_no' => 300],
            ["id" => "00301", "name" => "Create Product", "parent_id" => "00300", 'tab_name' => 'Create Product', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/products/create', 'order_no' => 301],
            ["id" => "00302", "name" => "Edit Product", "parent_id" => "00300", 'tab_name' => 'Edit Product', 'is_ui' => true, 'is_display_menu' => false, 'url_path' => 'admin/products/edit', 'order_no' => 302],

            ["id" => "00400", "name" => "Users", "parent_id" => "00400", 'tab_name' => 'Users', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/users', 'order_no' => 400],
            ["id" => "00401", "name" => "Create User", "parent_id" => "00400", 'tab_name' => 'Create user', 'is_ui' => true, 'is_display_menu' => true, 'url_path' => 'admin/create-user', 'order_no' => 401],
            ["id" => "00402", "name" => "Edit User", "parent_id" => "00400", 'tab_name' => 'Edit user', 'is_ui' => true, 'is_display_menu' => false, 'url_path' => 'admin/edit-user', 'order_no' => 402],


        ];


        foreach ($ar_permissions as $permission) {
            \App\Models\SmPermissions::create($permission);
        }
    }
}
