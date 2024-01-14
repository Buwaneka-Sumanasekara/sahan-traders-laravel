<?php

namespace App\CustomModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\CmCartHed;
use App\Models\CmCartDet;
use App\Models\BmBuyer;
use App\Models\PmProduct;
use App\Models\PmProductVariant;
use App\Models\PmProductVariantGroup;
use App\Models\PmProductAdditionalCost;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Facades\Image;

class CusModel_Cart extends Model
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
        'bm_buyer_id',
        'ar_cart_items'//array
    ];

    
      /*===========================Helper functions===========================================*/

      private function generateNextCartId()
      {
          $prefix="";  
          $lastId = CmCartHed::max("id");
          if ($lastId) {
              $lastNo = preg_replace("/[^0-9\.]/", '', $lastId);
              return $prefix."" . sprintf('%08d', $lastNo + 1);
          } else {
              return $prefix."00000001";
          }
      }
      private function generateNextCartItemId($cartId)
      {
          $lastId = CmCartDet::max("id")->where('cm_cart_hed_id',$cartId);
          if ($lastId) {
              return $lastId + 1;
          } else {
              return 1;
          }
      }


      // ======================== Getters ====================================
      private function getCartItemById($cartHedId,$id)
      {
          return CmCartDet::where('cm_cart_hed_id',$cartHedId)->where('id',$id)->first();
      }

      public function getActiveCartHedByBuyerId($buyerId)
      {
          return CmCartHed::where('bm_buyer_id',$buyerId)->where('cm_cart_status_id',config('global.cart_status.pending'))->first();
      }

      public function getActiveCartDetByProductIdAndHedId($cartHedId,$productId,$stockId,$variantId)
      {
          return CmCartDet::where('cm_cart_hed_id',$cartHedId)
          ->where('pm_product_id',$productId)
          ->where('pm_product_variant_id',$variantId)
          ->where('stk_batch_id',$stockId)
          ->first();
      }
     




      public function getAddressFromBuyer(BmBuyer $buyer,$addressType)
      {
          if($addressType=="shipping"){
              return $buyer->shippingAddress;
          }else if($addressType=="billing"){
              return $buyer->billingAddress;
          }else{
              throw new \Exception("Invalid address type");
          }    
      }

      //===========================CRUD functions : one item ===========================================


      private function calculateTotalAmount($cartHedId)
      {
          $cartHed=CmCartHed::find($cartHedId);
          $cartDets=CmCartDet::where('cm_cart_hed_id',$cartHedId)->get();

          $totalAmount=0;
          foreach ($cartDets as $cartDet) {
              $totalAmount+=$cartDet->amount;
          }

          $cartHed->gross_amount=$totalAmount;
          $cartHed->net_amount=$totalAmount - ($totalAmount*$cartHed->dis_per/100);
          $cartHed->update();
      }
     

      public function addToCart(array $options = [])
      {
        DB::beginTransaction();
        try {
            $buyer=BmBuyer::find($this->bm_buyer_id);

            $cartHed=$this->getActiveCartHedByBuyerId($this->bm_buyer_id);

            $cartHedId="";
            if($cartHed!==null){
                $cartHedId = $cartHed->id;
            }else{
                $cartHedId=$this->generateNextCartId();

                $buyerBillAddress=$this->getAddressFromBuyer($buyer,"billing");
                $buyerShipAddress=$this->getAddressFromBuyer($buyer,"shipping");


                $cartHed=CmCartHed::create([
                    'id'=>$cartHedId,
                    'bm_buyer_id'=>$this->bm_buyer_id,
                    'cm_cart_status_id'=>config('global.cart_status.pending'),
                    'cr_by_user_id'=>$buyer->user_id,
                    'md_by_user_id'=>$buyer->user_id,
                    'trn_date'=>now(),
                    'stkm_trn_status_id'=>config('global.stk_trn_status.pending'),
                    'stkm_trn_setup_id'=>config('global.trn_setup_id.cart'),
                    'trn_ref_no'=>"",
                    'gross_amount'=>0,
                    'dis_per'=>0,
                    'net_amount'=>0,
                    'ship_address'=>(isset($buyerShipAddress)?$buyerShipAddress->toJSON():null),
                    'ship_address_country_id'=>(isset($buyerShipAddress)?$buyerShipAddress->cdm_country_id:null),
                    'bill_address'=>(isset($buyerBillAddress)?$buyerBillAddress->toJSON():null),
                    'bill_address_country_id'=>(isset($buyerBillAddress->cdm_country_id)?$buyerBillAddress->cdm_country_id:null),
                ]);
            }
            
            $arCartItems=isset($this->ar_cart_items)? $this->ar_cart_items:[];

            foreach ($arCartItems as $cartItem) {
                $productId=$cartItem['product_id'];
                $stockId=$cartItem['stock_id'];
                $variantId=$cartItem['variant_id'];

                $product=CusModel_Product::getCartProductById($productId);

                if($product===null){
                    throw new \Exception("Product not found");
                }

                $cartDet=$this->getActiveCartDetByProductIdAndHedId($cartHedId,$productId,$stockId,$variantId);
                
                $qty=$cartItem['qty'];

                if($cartDet!==null){
                    $qty=$cartDet->qty+$qty;
                }

                if($product->isQtyAvailableInStock($stockId,$variantId,$qty)){
                    throw new \Exception("Product is out of stock");
                }

             
                //Check existing Cart det

                $additionalCostId=isset($cartItem['additional_cost_id'])?$cartItem['additional_cost_id']:null;
                
                $additionalCost=null;

                if($additionalCostId!==null){
                    $additionalCost=PmProductAdditionalCost::find($additionalCostId);
                }


                if($cartDet!==null){//has item
                    $cartDet->qty=$qty;

                    $temAmount=$cartDet->sprice*$qty;

                    if($additionalCost!==null){
                        $cartDet->additional_product_cost_id=$additionalCost->id;
                        $cartDet->additional_product_cost=$additionalCost->amount;
                    }

                    $cartDet->amount=$temAmount - ($cartDet->line_dis_amt + ($temAmount*$cartDet->line_dis_per/100));
                    $cartDet->update();
                }else{

                    $unitGroupId=$cartItem['unit_group_id'];
                    $unitId=$cartItem['unit_id'];
                                   
                    $sellPrice=$product->getSellPrice($stockId,$variantId);
                    $costPrice=$product->getCostPrice($stockId,$variantId);

                    
                    $cartItemId=$this->generateNextCartItemId($cartHedId);

                    $cartDet= new CmCartDet;

                    $cartDet->id=$cartItemId;
                    $cartDet->cprice=$sellPrice;
                    $cartDet->sprice=$costPrice;
                    $cartDet->qty=$qty;
                    $cartDet->free_qty=0;
                    $cartDet->line_dis_per=0;
                    $cartDet->line_dis_amt=0;
                    $cartDet->amount=$sellPrice*$qty;
                    $cartDet->pm_unit_group_id=$unitGroupId;
                    $cartDet->pm_unit_id=$unitId;
                    $cartDet->cm_cart_hed_id=$cartHedId;
                    $cartDet->product_id=$productId;
                    $cartDet->stk_batch_id=$stockId;
                    $cartDet->pm_product_variant_id=$variantId;
                    $cartDet->pm_product_variant_group_id=$product->pm_product_variant_group_id;

                    if($additionalCost!==null){
                        $cartDet->additional_product_cost_id=$additionalCost->id;
                        $cartDet->additional_product_cost=$additionalCost->amount;
                    }

                    $cartDet->save();
                }  
            }

            DB::commit();

            $this->calculateTotalAmount($cartHedId);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

      }
}
