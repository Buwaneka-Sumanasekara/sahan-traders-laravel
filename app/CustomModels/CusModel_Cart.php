<?php

namespace App\CustomModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\CmCartHed;
use App\Models\CmCartDet;
use App\Models\BmBuyer;
use App\Models\PmProductAdditionalCost;

use Illuminate\Support\Facades\DB;


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
              return $prefix."". sprintf('%08d', $lastNo + 1);
          } else {
              return $prefix."00000001";
          }
      }
      private function generateNextCartItemId(string $cartId)
      {
          $lastId = CmCartDet::where('cm_cart_hed_id',$cartId)->max("id");
          if ($lastId) {
              return $lastId + 1;
          } else {
              return 1;
          }
      }


      // ======================== Getters ====================================
      private function getCartItemById(string $cartHedId,string $id)
      {
          return CmCartDet::where('cm_cart_hed_id',$cartHedId)->where('id',$id)->first();
      }

      private function getActiveCartHedByBuyerId(string $buyerId)
      {
          return CmCartHed::where('bm_buyer_id',$buyerId)->where('cm_cart_status_id',config('global.cart_status.pending'))->first();
      }

      private function getActiveCartDetByProductIdAndHedId(
        string $cartHedId,
        string $productId,
        string $stockId,
        string $variantId
        )
      {
          return CmCartDet::where('cm_cart_hed_id',$cartHedId)
          ->where('product_id',$productId)
          ->where('pm_product_variant_id',$variantId)
          ->where('stk_batch_id',$stockId)
          ->first();
      }
     
      private function getAddressFromBuyer(BmBuyer $buyer,string $addressType)
      {
          if($addressType=="shipping"){
              return $buyer->shippingAddress;
          }else if($addressType=="billing"){
              return $buyer->billingAddress;
          }else{
              throw new \Exception("Invalid address type");
          }    
      }


    //===========================GET functions : all items ===========================================

      public static  function getActiveCartHedByUserId(string $userId)
      {
        $buyer=BmBuyer::find($userId);
        $cartHed=CmCartHed::where('bm_buyer_id',$buyer->id)->where('cm_cart_status_id',config('global.cart_status.pending'))->first();
        return $cartHed;
      }

      //===========================CRUD functions : one item ===========================================


      private function calculateTotalAmount(string $cartHedId)
      {
          $cartHed=CmCartHed::find($cartHedId);
          $cartDets=CmCartDet::where('cm_cart_hed_id',$cartHedId)->get();

          $totalAmount=0;
          foreach ($cartDets as $cartDet) {
              $totalAmount+=$cartDet->amount;
          }

          $taxPer=0;
          $isEnableTax=config("setup.en_tax");
          if($isEnableTax){
            $taxPer=config("setup.tax_per");
          }

          $cartHed->tax_per=$taxPer;


          $disPer=isset($cartHed->dis_per)?$cartHed->dis_per:0;          
          

          $cartHed->gross_amount=$totalAmount;

          //Tax will be calculate to gross amount
          $netAmount=$totalAmount - ($totalAmount*$disPer/100) + ($totalAmount*$taxPer/100);

          $cartHed->net_amount=$netAmount;
          $cartHed->update();
      }
     

      public function addToCart(array $options = [])
      {
        DB::beginTransaction();
        try {
            $buyer=BmBuyer::find($this->user_id);

            if($buyer===null){
                throw new \Exception("You are not a buyer");
            }
            $cartHed=$this->getActiveCartHedByBuyerId($buyer->id);

            $cartHedId="";
            if($cartHed!==null){
                $cartHedId = $cartHed->id;
            }else{
                $cartHedId=$this->generateNextCartId();

                $buyerBillAddress=$this->getAddressFromBuyer($buyer,"billing");
                $buyerShipAddress=$this->getAddressFromBuyer($buyer,"shipping");


                $cartHed=new CmCartHed;

                $cartHed->id=$cartHedId;
                $cartHed->bm_buyer_id=$buyer->id;
                $cartHed->cm_cart_status_id=config('global.cart_status.pending');
                $cartHed->cr_by_user_id=$buyer->user_id;
                $cartHed->md_by_user_id=$buyer->user_id;
                $cartHed->trn_date=now();
                $cartHed->stkm_trn_status_id=config('global.stk_trn_status.pending');
                $cartHed->stkm_trn_setup_id=config('global.trn_setup_id.cart');
                $cartHed->trn_ref_no="";
                $cartHed->gross_amount=0;
                if(config("setup.en_tax")){
                    $cartHed->tax_per=config("setup.tax_per");
                }else{
                    $cartHed->tax_per=0;
                }
                $cartHed->tracking_no="";
                $cartHed->shipping_cost=0;
                $cartHed->dis_per=0;
                $cartHed->net_amount=0;
                $cartHed->ship_address=(isset($buyerShipAddress)?$buyerShipAddress->toJSON():null);
                $cartHed->ship_address_country_id=(isset($buyerShipAddress)?$buyerShipAddress->cdm_country_id:null);
                $cartHed->bill_address=(isset($buyerBillAddress)?$buyerBillAddress->toJSON():null);
                $cartHed->bill_address_country_id=(isset($buyerBillAddress->cdm_country_id)?$buyerBillAddress->cdm_country_id:null);
                $cartHed->save();



                // $cartHed=CmCartHed::create([
                //     'id'=>$cartHedId,
                //     'bm_buyer_id'=>$buyer->id,
                //     'cm_cart_status_id'=>config('global.cart_status.pending'),
                //     'cr_by_user_id'=>$buyer->user_id,
                //     'md_by_user_id'=>$buyer->user_id,
                //     'trn_date'=>now(),
                //     'stkm_trn_status_id'=>config('global.stk_trn_status.pending'),
                //     'stkm_trn_setup_id'=>config('global.trn_setup_id.cart'),
                //     'trn_ref_no'=>"",
                //     'gross_amount'=>0,
                //     'dis_per'=>0,
                //     'net_amount'=>0,
                //     'ship_address'=>(isset($buyerShipAddress)?$buyerShipAddress->toJSON():null),
                //     'ship_address_country_id'=>(isset($buyerShipAddress)?$buyerShipAddress->cdm_country_id:null),
                //     'bill_address'=>(isset($buyerBillAddress)?$buyerBillAddress->toJSON():null),
                //     'bill_address_country_id'=>(isset($buyerBillAddress->cdm_country_id)?$buyerBillAddress->cdm_country_id:null),
                // ]);
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

                if(!$product->isQtyAvailableInStock($stockId,$variantId,$qty)){
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
                    $cartDet->cprice=$costPrice;
                    $cartDet->sprice=$sellPrice;
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
