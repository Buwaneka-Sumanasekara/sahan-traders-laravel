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
        'prop_width',
        'prop_height',
        'prop_depth',
        'prop_weight'
    ];


    /*===========================Helper functions===========================================*/

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


    private function saveDefaultBulkImages($prodId)
    {
        $path = 'img_defaults/products/' . $prodId . '_*';
        $filtered_file_names = glob(public_path($path));
        $ar_prod_images = [];
        $i = 0;
        foreach ($filtered_file_names as $file_path) {
            $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
            $file_name = $prodId . "_" . $i . "_" . time() . "." . $file_extension;
            $ar_prod_images[] = [
                "file_name" => $file_name,
                "is_primary" => ($i == 0 ? 1 : 0),
                "file_path" => $file_path
            ];
            $i++;
        }

        if (!empty($ar_prod_images)) {
            $this->uploadProductImages($prodId, $ar_prod_images);
        }
    }


    private function uploadProductImages($prodId, array $images = [])
    {
        /*
        expected format
         [
            is_primary => 1, or 0
            file_name => "image1.jpg"
         ]
        
        */

        foreach ($images as $image) {
            $file_name = $image['file_name'];
            $file_path = $image['file_path'];


            $product_path = 'public/images/products/' . $prodId;
            $product_thumbnails_path = 'public/images/products/' . $prodId . "/thumbnails";
            $img = Image::make($file_path);

            //save thumbnail
            $image_thumbnail = $img->resize(config("global.product_image_sizes.thumbnail.width"), config("global.product_image_sizes.thumbnail.height"), function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::put($product_thumbnails_path . "/" . $file_name, $image_thumbnail->stream());

            //save medium images

            $image_medium = $img->resize(config("global.product_image_sizes.medium.width"), config("global.product_image_sizes.medium.height"), function ($constraint) {
                $constraint->aspectRatio();
            })->insert(public_path('img/water_mark.png'), 'bottom-right', 10, 10);

            Storage::put($product_path . "/" . $file_name, $image_medium->stream());
        }

        $this->saveProductImagesToTable($prodId, $images);
    }

    private function saveProductImagesToTable(string $prodId, array $images = [])
    {

        /*
        expected format
         [
            is_primary => 1, or 0
            file_name => "image1.jpg"
         ]
        
        */

        foreach ($images as $image) {
            $file_name = $image['file_name'];
            $images = [
                'id' => PmProductImages::where("pm_product_id", $prodId)->max("id") + 1,
                'pm_product_id' => $prodId,
                'name' => $file_name,
                'path' => 'products/' . $prodId . "/" . $file_name, //not needed
                'active' => 1,
                'cr_by_user_id' => $this->cr_by_user_id,
                'md_by_user_id' => $this->md_by_user_id,
                'is_primary' => $image['is_primary'],
            ];



            PmProductImages::create($images);
        }
    }


    /*============================Get product==============================================*/

    public  static function getProducts($limit = 10)
    {
        return PmProduct::where("active", true)->paginate($limit);
    }
    public  static function getFeaturedProducts($limit = 10)
    {
        return PmProduct::where('is_featured_product', true)->where('active', true)->paginate($limit);
    }


    public static function getProductBySlug($slug = "")
    {
        return PmProduct::where("slug", $slug)->first();
    }

    public static function getProductById($id)
    {
        return PmProduct::find($id);
    }
















    /*============================Save /Update product==============================================*/
    public function save(array $options = [])
    {
        DB::beginTransaction();
        try {

            $genId = "" . $this->generateNextId();

            $prod = [
                'id' => $genId,
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'active' => isset($this->active) ? $this->active : 1,
                'note' => $this->note,
                'note_html' => $this->note_html,
                'pm_group1_id' => $this->pm_group1_id,
                'pm_group2_id' => $this->pm_group2_id,
                'pm_group3_id' => $this->pm_group3_id,
                'pm_group4_id' => $this->pm_group4_id,
                'pm_group5_id' => $this->pm_group5_id,
                'cr_by_user_id' => $this->cr_by_user_id,
                'md_by_user_id' => $this->md_by_user_id,
                'en_batch' => isset($this->en_batch) ? $this->en_batch : config('setup.en_batch'),
                'pm_unit_group_id' => $this->pm_unit_group_id,
                'is_inquiry_item' => (isset($this->is_inquiry_item) ? $this->is_inquiry_item : 0),
                'is_featured_product' => (isset($this->is_featured_product) ? $this->is_featured_product : 0),
                'prop_width' => $this->prop_width,
                'prop_height' => $this->prop_height,
                'prop_depth' => $this->prop_depth,
                'prop_weight' => $this->prop_weight
            ];

            $product = PmProduct::create($prod);

            /*==========================*/
            /*  Save Product Images     */

            if (isset($this->is_from_seeds)) {
                $this->saveDefaultBulkImages($genId);
            } else {
                if (isset($this->images)) {
                    $this->uploadProductImages($genId, $this->images);
                }
            }
            /*==========================*/

            $prodStock = [
                'pm_product_id' => $genId,
                'batch' => $this->getCurrentStockId($genId),
                'sell_price' => $this->sell_price ? $this->sell_price : 0,
                'cost_price' => $this->sell_price ? $this->sell_price : 0,
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
