<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmUnitHasPmUnitGroup extends Model
{
    use HasFactory;
    protected $table = 'pm_unit_has_pm_unit_group';

    protected $fillable = [
        'pm_unit_id',
        'pm_unit_group_id',
        'volume',
        'is_base',
        'is_sales_unit',
        'is_purchase_unit',
        'active',
    ];

    public $timestamps = false;

    public function pm_unit()
    {
        return $this->belongsTo(PmUnit::class, 'pm_unit_id');
    }

    public function pm_unit_group()
    {
        return $this->belongsTo(PmUnitGroup::class, 'pm_unit_group_id');
    }

    public function get_base_unit()
    {
        return PmUnitHasPmUnitGroup::where('pm_unit_group_id', $this->pm_unit_group_id)->where('is_base', 1)->first();
    }
}
