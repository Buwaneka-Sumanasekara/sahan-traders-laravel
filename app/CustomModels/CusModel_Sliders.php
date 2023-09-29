<?php

namespace App\CustomModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\CdmSiteSliders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CusModel_Sliders extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'title',
        'subtitle',
        'img_path',
        'active',
        'order',
        'link',
        'link_text',
        'link_target'
    ];

    private function generateNextId()
    {
        $lastId = CdmSiteSliders::max("id");
        if ($lastId) {
            return $lastId + 1;
        } else {
            return 1;
        }
    }











    // Override the save method
    public function save(array $options = [])
    {
        DB::beginTransaction();
        try {

            $genId = "" . $this->generateNextId();

            $prod = [
                'id' => $genId,

            ];

            $product = CdmSiteSliders::create($prod);









            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
