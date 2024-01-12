<?php

namespace App\CustomModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\PmProduct;
use App\Models\PmProductStock;
use App\Models\PmUnitHasPmUnitGroup;
use App\Models\PmProductImages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Facades\Image;

class CusModel_ShipAndCoRates extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'carrier_id';
    public $timestamps = false;

    protected $fillable = [
        'carrier_id',
        'carrier',
        'service',
        'currency',
        'price',
        'surcharges' //json
    ];

    
}
