<?php

namespace App\Http\Controllers\Front;

use App\Mail\orderSuccessMail;
use App\Mail\NotifyMail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Cart, CartItem, User};
use App\Models\Option;
use App\Models\Paidcontent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Session;
use App\Traits\StripeTrait;
use App\Traits\ApiResponse;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Mail;


class CartController extends Controller
{
    use StripeTrait, ApiResponse;

//    public function __construct(){
//        $this->middleware('auth');
//    }

    public function index(Request $request)
    {
        $font = Option::where('user_id', Auth::id())->pluck('preffered_font')->first();
        $user_id = Auth::user()->id;
        $cart_id = Session::get('cart_id');
        if (!$cart_id) {
            return redirect()->route('publicstore');
        } else {
            $cartItems = CartItem::with('paidcontent')->where('cart_id', $cart_id)->get();
            $total = CartItem::where('cart_id', $cart_id)->sum('price');
        }

        if (Auth::user()->customer_id == null) {
            $customer = $this->createCustomer(Auth::user()->email, Auth::user()->username);
            $user = User::where('id', Auth::id())->update(['customer_id' => $customer->id]);
            $customer_id = $customer->id;
        } else {
            $customer_id = Auth::user()->customer_id;
        }

        $customer_cards = $this->customerCardList($customer_id, 10);

        return view('front.checkout', compact('cartItems', 'total', 'font', 'customer_cards', 'customer_id'));
    }

    public function add_to_cart(Request $request)
    {
        $user_id = Auth::user()->id;
        $paidcontent_id = $request->paidcontent_id;
        $price = $request->price;
        $quantity = 1;
        $cart_id = session()->get('cart_id');

        if (is_null($cart_id)) {
            $cart = Cart::create([
                'user_id' => Auth::user()->id,
                'paid_status' => 0,
                'total' => 0,
            ]);
            $cart_id = $cart->id;
            session(['cart_id' => $cart_id]);
        }

        $cartItem = CartItem::create([
            'cart_id' => $cart_id,
            'paidcontent_id' => $paidcontent_id,
            'price' => $price,
            'quantity' => $quantity
        ]);

        $response = [
            'code' => 200,
            'message' => "Successfully added to your cart"
        ];
        return response()->json($response, 200);
    }

    public static function toStripeFormat(float $amount)
    {
        return number_format($amount * 100,0,"","");
    }

    public function checkout(Request $request)
    {
        $cart_id = Session::get('cart_id');
        $user_id = Auth::user()->id;
        $cartItems = CartItem::with('paidcontent')->where('cart_id', $cart_id)->with('paidcontent.user')->get();
        $total = CartItem::where('cart_id', $cart_id)->sum('price');

        $adminamount = array();
        $useramount = array();

        if ($request->has('card')) {

            $request->validate([
                "card" => 'required',
                "cart_id" => "required",
            ]);

    //        $balance = $this->getBalance();
    //        $trasfer = $this->createTrasfer(self::toStripeFormat(1), 'USD', "acct_1N8pgpPLrsVVUMav");

    //        $charge = $this->createCardCharge(self::toStripeFormat($total), Auth::user()->customer_id, 'card_1MpoOwLpE2nvK4R4rNqQUdKL');
    //        $create_trasfer = $this->createTrasfer(1, 'sek', 'acct_1Mpo1LPqD07GFRfD', ["transfer_group" => 'Order_10', "metadata" => ["product" => 'pro_id']]);

            $charge = $this->createCardCharge(
                self::toStripeFormat($total),
                Auth::user()->customer_id,
                $request->card,
                'USD',
                ["description" => $cart_id]);


        } else {

            // Stripe direct payment without saving card
            $response = $this->createCharge(self::toStripeFormat($request->total), $request->stripeToken, $cart_id);
            Log::debug("response: " . print_r($response, true));

            if ($response['status'] == 402) {
                return back()->with(['error_message' => $response['message']]);
            }
        }


        foreach ($cartItems as $ci) {
            if (isset($ci->paidcontent, $ci->paidcontent->user) && $ci->paidcontent->user->stripe_acc !== null) {
                $trasfer_amt = $ci->price * 85 / 100;
                $trasfer = $this->createTrasfer(self::toStripeFormat($trasfer_amt), 'USD', $ci->paidcontent->user->stripe_acc);
                array_push($adminamount, $ci->price * 15 / 100);
                array_push($useramount, $ci->price * 85 / 100);
                $paind_content = Paidcontent::where('id', $ci->paidcontent_id)->with(['user'])->first();
            }


        }


        $adminamount = array_sum($adminamount);
        $useramount = array_sum($useramount);
        $total = $request->total;
        $cart_id = $request->cart_id;
        $paid_status = 1;
        $cart = Cart::where('id', $cart_id)->update([
            'user_id' => $user_id,
            'paid_status' => $paid_status,
            'total' => $total,
        ]);


        return redirect(route('order_success'))->with("success", "You have successfully completed the transaction");

    }

    public function orderSuccess(Request $request)
    {
        $font = Option::where('user_id', Auth::id())->pluck('preffered_font')->first();
        $user_id = Auth::user()->id;
        $cart_id = Session::get('cart_id');
        if (!$cart_id) {
            return redirect()->route('publicstore');
        } else {
            $cartItems = CartItem::with('paidcontent')->where('cart_id', $cart_id)->get();
            $total = CartItem::where('cart_id', $cart_id)->sum('price');
        }


     //   Mail::to(Auth::user()->email)->send(new orderSuccessMail($cart_id));
       //$mail = Mail::to('fordeveloperonly@gmail.com')->send(new orderSuccessMail($cart_id));

        Session::forget('cart_id');

        return view('front.order_success', compact('cartItems', 'total', 'font' ));
    }

    public function removeItem(Request $request)
    {
        $id = $request->id;
        $res = CartItem::where('id', $id)->delete();
        $response = [
            'code' => 200,
            'message' => "Successfully removed from Cart"
        ];
        return response()->json($response, 200);
    }

    public function getCartItems()
    {
        $user_id = Auth::user()->id;
        $cart_id = Session::get('cart_id');
        if (!$cart_id) {
            $response = [
                'code' => 404,
                'message' => "Successfully removed from Cart"
            ];
            return response()->json($response, 404);
        } else {
            $cartItems = CartItem::with('paidcontent')->where('cart_id', $cart_id)->get();
            $total = CartItem::where('cart_id', $cart_id)->sum('price');
            $response = [
                'code' => 200,
                'message' => "Successfully removed from Cart",
                'total' => number_format($total,2),
                'cartItems' => $cartItems
            ];
            return response()->json($response, 200);
        }
    }
}
