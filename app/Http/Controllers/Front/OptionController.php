<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function optionindex(){
      
       
         return view('front.option');  
     
     }
}
