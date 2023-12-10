<?php

namespace App\Http\Traits;

use App;
use App\Models\UmUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait CommonTrait
{
    public function common_generate_next_cart_no($pre_no)
    {
        if ($pre_no) {
            $string = preg_replace("/[^0-9\.]/", '', $pre_no);
            return '' . sprintf('%08d', $string + 1);
        } else {
            return "00000001";
        }
    }

    public function common_generate_next_trn_no($pre_no)
    {
        if ($pre_no) {
            $string = preg_replace("/[^0-9\.]/", '', $pre_no);
            return '' . sprintf('%08d', $string + 1);
        } else {
            return "00000001";
        }
    }
}
