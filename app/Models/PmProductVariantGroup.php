<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmProductVariantGroup extends Model
{
    use HasFactory;
    protected $table = 'pm_product_variant_group';
    public $incrementing = false;
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function variants(): HasMany
    {
        return $this->hasMany(PmProductVariant::class);
    }
}
