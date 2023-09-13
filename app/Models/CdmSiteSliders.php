<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CdmSiteSliders extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cdm_site_sliders';
    protected $fillable = [
        'title',
        'subtitle',
        'img_path',
        'active',
        'order',
        'link',
        'link_text',
        'link_target'
    ];
}
