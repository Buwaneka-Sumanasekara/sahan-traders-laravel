<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmProduct extends Model
{

    use HasFactory;
    protected $table = 'pm_product';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'active',
        'pm_group1_id',
        'pm_group2_id',
        'pm_group3_id',
        'pm_group4_id',
        'pm_group5_id',
        'slug',
        'is_inquiry_item',
        'note_html',
        'note',
    ];
}
