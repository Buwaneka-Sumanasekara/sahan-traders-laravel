<?php

namespace App\Http\Traits;

use App;
use App\CustomModels\CusModel_Product;
use App\CustomModels\CusModel_ShipAndCoRates;
use App\Models\BmBuyerAddress;
use App\Models\UmUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait ShipAndCoTrait
{
    public function calculateShipping(BmBuyerAddress $address, CusModel_Product ...$products)
    {
    }
}
