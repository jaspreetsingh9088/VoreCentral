<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PayPalService;
use Exception;
use Log;
use App\Models\Cart;
use Session;
use Illuminate\Support\Facades\Auth;

class PayPalController extends Controller
{
    protected $paypal;

    public function __construct(PayPalService $paypal)
    {
        $this->paypal = $paypal;
    }

    public function createOrder(Request $request)
    {
        $order = $this->paypal->createOrder($request->amount);

        return response()->json($order);
    }

    public function captureOrder(Request $request)
    {
        $payment = $this->paypal->capturePayment($request->orderID);
        try{
            if($payment['status']=="COMPLETED"){
                $cart_id = Session::get('cart_id');
                $user_id = Auth::user()->id;

                $cart = Cart::where('id', $cart_id)->update([
                    'user_id' => $user_id,
                    'paid_status' =>1,
                ]);
            }

        }catch(Exception $e){

        }
        return response()->json($payment);
    }
}