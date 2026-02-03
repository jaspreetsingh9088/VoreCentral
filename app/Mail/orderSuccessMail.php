<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;

class orderSuccessMail extends Mailable
{
    use Queueable, SerializesModels;
    public $app_name;
    public $user_id;
    public $username;
    public $cart_id;
    public $cart;
    public $cartItems;
    public $total;

    public function __construct($cart_id)
    {
        $this->app_name = config('app.name');
        $this->cart_id = $cart_id;
        $this->user_id = Auth::user()->id;
        $this->username = Auth::user()->username;
        $this->cartItems = CartItem::with('paidcontent')->where('cart_id', $cart_id)->with('paidcontent.user')->get();
        $this->total = CartItem::where('cart_id', $cart_id)->sum('price');
    }
  
    public function build()
    {
        return $this->subject('Order successfully placed')->view('mail.order_placed');
        
    }
}

