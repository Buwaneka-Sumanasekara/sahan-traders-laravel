<?php

namespace App\Http\Controllers;

use App\CustomModels\CusModel_Payments;
use App\Exceptions\EmailNotVerifiedException;
use App\Http\Resources\CommonResponseResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\StripePaymentInitResource;
use App\Http\Resources\StripePaymentIntentResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [];
    }

    // View
    public function stripe_payments(Request $request, $sessionId)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {

                $cartPay = new CusModel_Payments();

                $paymentInfo = $cartPay->getVerifyPaymentInfoFromSessionId($sessionId);

                if ($paymentInfo) {
                    return view('pages.general.stripe-payment', ['sessionId' => $sessionId, 'stripe_pk' => config('setup.stripe_key')]);
                } else {
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

    public function api_getPaymentCheckoutInfo(Request $request, $sessionId)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                $cartPay = new CusModel_Payments();

                $paymentInfo = $cartPay->getPaymentInfoFromSessionId($sessionId);
                if ($paymentInfo) {
                    return (new StripePaymentInitResource($paymentInfo));
                } else {
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

    public function api_createStripePaymentIntent(Request $request)
    {
        try {

            if ($request->user()->hasVerifiedEmail()) {
                $cartPay = new CusModel_Payments();
                $userId = $request->user()->id;

                $sessionId = $request->string('sessionId')->trim();

                if (!$sessionId) {
                    throw new \Exception("Invalid Session Id");
                }

                $paymentInfo = $cartPay->createStripePaymentIntent($sessionId, $userId);
                if ($paymentInfo) {
                    return (new StripePaymentIntentResource($paymentInfo));
                } else {
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


    /* =============== Webhook handle ======================================== */

    public function webhook_stripe(Request $request)
    {
        try {
            $payload = json_decode($request->getContent(), true);
            $method = 'handle' . Str::studly(str_replace('.', '_', $payload['type']));

            if (method_exists($this, $method)) {
                $response = $this->{$method}($payload);
                return $response;
            }

            return $this->missingMethod();
        } catch (\Exception $e) {
            $errorResponse = new ErrorResource($e);
            return $errorResponse;
        }
    }


    /*============== Webhook handle: Stripe methods ===================*/

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  array  $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function missingMethod($parameters = [])
    {
        return new Response;
    }

    /**
     * Handle successful calls on the controller.
     *
     * @param  array  $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function successMethod($parameters = [])
    {
        return new Response('Webhook Handled', 200);
    }


    protected function handlePaymentIntentSucceeded(array $payload)
    {
        return  $payload;
    }

    protected function handlePaymentIntentPaymentFaild(array $payload)
    {
    }
}
