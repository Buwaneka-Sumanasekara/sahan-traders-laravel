<?php

namespace App\Http\Controllers;

use App\CustomModels\CusModel_Payments;
use App\Exceptions\EmailNotVerifiedException;
use App\Http\Resources\ErrorResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Intervention\Image\Colors\Rgb\Channels\Red;

class PaymentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [];
    }

    // View
    public function stripe_payments(Request $request,$sessionId)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                
                $cartPay = new CusModel_Payments();

                $paymentInfo=$cartPay->getVerifyPaymentInfoFromSessionId($sessionId);

                if($paymentInfo){
                    return view('pages.general.stripe-payment',['sessionId'=>$sessionId,'stripe_pk'=>config('setup.stripe_key')]);
                }else{
                    throw new \Exception("Invalid Payment Session");
                }
               
            } else {
                throw new EmailNotVerifiedException();
            }
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->withErrors([
                'message' => $e->getMessage(),
            ]);
        }
    }


    /* ============================ API ============================================ */

    public function api_getPaymentCheckoutInfo(Request $request,$sessionId){
        try {
            if ($request->user()->hasVerifiedEmail()) {
                
           

                $cartPay = new CusModel_Payments();

                $paymentInfo=$cartPay->getPaymentInfoFromSessionId($sessionId);
                if($paymentInfo){
                    return $paymentInfo;
                }else{
                    throw new \Exception("Invalid Payment Session");
                }

               
            } else {
                throw new EmailNotVerifiedException();
            }
        } catch (\Exception $e) {
            $errorResponse = new ErrorResource($e);
            return $errorResponse;
        }
    }
   
}
