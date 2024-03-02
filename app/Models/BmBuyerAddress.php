<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BmBuyerAddress extends Model
{
    use HasFactory;
    protected $table = 'bm_buyer_addresses';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id', // 'id' is the primary key, so it should be included in the fillable array
        'name',
        'address_1',
        'address_2',
        'city',
        'zip_code',
        'cdm_country_id',
        'province_name',
        'contact_number',
    ];



    public function country(): BelongsTo
    {
        return $this->belongsTo(CdmCountry::class,"cdm_country_id","id");
    }

  

    /**
     * Get the collection of items as JSON.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }
}
