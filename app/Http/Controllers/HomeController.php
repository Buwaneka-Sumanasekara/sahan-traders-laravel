<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomModels\CusModel_Product;


class HomeController extends Controller
{
    public function index()
    {
        return view('pages.general.home');
    }
}
