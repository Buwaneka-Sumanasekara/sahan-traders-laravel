<?php

namespace App\CustomModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\CdmSiteSliders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Facades\Image;

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


    private function saveDefaultBulkImages()
    {
        $path = 'img_defaults/sliders/*';
        $filtered_file_names = glob(public_path($path));
        $ar_sliders = [];
        $i = 1;
        foreach ($filtered_file_names as $file_path) {
            $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
            $file_name = "slider_" . $i . "." . $file_extension;
            $ar_sliders[] = [
                "file_name" => $file_name,
                "file_path" => $file_path,
            ];
            $i++;
        }

        if (!empty($ar_sliders)) {
            $this->uploadSliderImages($ar_sliders);
        }
    }


    private function uploadSliderImages(array $sliders = [])
    {
        /*
        expected format
         [
             "file_name" => "slider_1.jpg",
             "file_path" => "path/to/slider_1.jpg"
         ]
        
        */

        $uploaded_sliders = [];
        foreach ($sliders as $slide) {
            $file_name = $slide['file_name'];
            $file_path = $slide['file_path'];


            $image_path = 'public/images/sliders';
            $img = Image::make($file_path);

            //save sliders
            $img->resize(config("global.slider_image_sizes.home.width"), config("global.slider_image_sizes.home.height"), function ($constraint) {
                $constraint->aspectRatio();
            });

            $generated_path = $image_path . "/" . $file_name;

            $status = Storage::put($generated_path, $img->stream());

            if ($status) {
                $slider["img_path"] =  $file_name;
                $uploaded_sliders[] = $slider;
            }
        }

        if (!empty($uploaded_sliders)) {
            $this->saveSliders($uploaded_sliders);
        }
    }





    private function saveSliders(array $sliders = [])
    {
        /*
        expected format
         [
             "img_path" => "public/images/sliders/slider_1.jpg",
             //other slider fields
         ]
        
        */

        foreach ($sliders as $slider) {
            $img_path = $slider['img_path'];

            $slider = [
                'id' => $this->generateNextId(),
                'title' => isset($slider['title']) ? $slider['title'] : "",
                'subtitle' => isset($slider['subtitle']) ? $slider['subtitle'] : "",
                'img_path' => $img_path,
                'active' => isset($slider['active']) ? $slider['active'] : 1,
                'order' => isset($slider['order']) ? $slider['order'] : 0,
                'link' => isset($slider['link']) ? $slider['link'] : "",
                'link_text' => isset($slider['link_text']) ? $slider['link_text'] : "",
                'link_target' => isset($slider['link_target']) ? $slider['link_target'] : "",
            ];

            CdmSiteSliders::create($slider);
        }
    }





    // Override the save method
    public function save(array $options = [])
    {
        DB::beginTransaction();
        try {
            if (isset($this->is_from_seeds)) {
                $this->saveDefaultBulkImages();
            } else {
                $this->uploadSliderImages($this->sliders);
            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
