<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Journal;
use Illuminate\Support\Facades\Auth;
use Session;


class JournalController extends Controller
{
   
    public function index(){
      
       $JournalData = Journal::get()->toArray();
        return view('front.user.journal',compact('JournalData'));  
    
    }
    
    public function create(Request $request){
         
         $this->validate($request, [
           'title' => 'required',
           ]);
         
            $Journal = new Journal ;
            $Journal->title  = $request->title;
            $Journal->userid  = Auth::user()->id;
            $Journal->save();
           
            $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return response()->json($response, 200);
       }
       
}
