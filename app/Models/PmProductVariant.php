<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmProductVariant extends Model
{
    use HasFactory;
    protected $table = 'pm_product_variant';
    public $incrementing = false;
    public $timestamps = false;

    public function variantGroup(): BelongsTo
    {
        return $this->belongsTo(PmProductVariantGroup::class, 'variant_group_id', "id");
    }
}
