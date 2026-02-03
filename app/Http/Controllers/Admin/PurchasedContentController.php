<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;

class PurchasedContentController extends Controller
{
    public function index(){
        $carts = Cart::where('paid_status','1')->pluck('id');
        $purchasedcontent = CartItem::with('paidcontent')->whereIn('cart_id',$carts)->get();
        return view('admin.purchasedcontent.index',compact('purchasedcontent'));
    }
}
