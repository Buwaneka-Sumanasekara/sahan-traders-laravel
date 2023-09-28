<?php

namespace App\CustomModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\PmProduct;
use App\Models\PmProductStock;
use App\Models\PmUnitHasPmUnitGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CusModel_Product extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $timestamps = false;

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

    private function generateNextId()
    {
        $lastId = PmProduct::max("id");
        if ($lastId) {
            $lastNo = preg_replace("/[^0-9\.]/", '', $lastId);
            return "I" . sprintf('%05d', $lastNo + 1);
        } else {
            return "I00001";
        }
    }

    private function generateNextStockId($proId)
    {
        $lastId = PmProductStock::where("pm_product_id", $proId)->max("batch");
        if ($lastId) {
            $nextId = (int)$lastId + 1;
            return "" . sprintf('%03d', $nextId);
        } else {
            return "001";
        }
    }
    private function getCurrentStockId($proId)
    {
        $lastId = PmProductStock::where("pm_product_id", $proId)->max("batch");
        if ($lastId) {
            return "" . $lastId;
        } else {
            return "001";
        }
    }


    private function getBaseUnitId($unitGroupId)
    {
        $unit = PmUnitHasPmUnitGroup::where("pm_unit_group_id", $unitGroupId)->where("is_base", 1)->first();
        if ($unit) {
            return $unit->pm_unit_id;
        } else {
            return null;
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
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'active' =>  $this->active || 1,
                'note' => $this->note,
                'note_html' => $this->note_html,
                'pm_group1_id' => $this->pm_group1_id,
                'pm_group2_id' => $this->pm_group2_id,
                'pm_group3_id' => $this->pm_group3_id,
                'pm_group4_id' => $this->pm_group4_id,
                'pm_group5_id' => $this->pm_group5_id,
                'cr_by_user_id' => $this->cr_by_user_id,
                'md_by_user_id' => $this->md_by_user_id,
                'en_batch' => $this->en_batch || config('setup.en_batch'),
                'pm_unit_group_id' => $this->pm_unit_group_id,
                'is_inquiry_item' => $this->is_inquiry_item,
            ];

            $product = PmProduct::create($prod);





            $prodStock = [
                'pm_product_id' => $genId,
                'batch' => $this->getCurrentStockId($genId),
                'sell_price' => $this->sell_price || 0,
                'cost_price' => $this->sell_price || 0,
                'pm_unit_group_id' => $product->pm_unit_group_id,
                'qty' => config('setup.en_auto_add_stock') ? 1 : 0,
                'pm_unit_id' => $this->getBaseUnitId($product->pm_unit_group_id),
                'active' => 1,
                'cr_by_user_id' => $product->cr_by_user_id,
                'md_by_user_id' => $product->md_by_user_id,
            ];


            PmProductStock::create($prodStock);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
