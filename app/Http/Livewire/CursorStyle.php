<?php

namespace App\Http\Livewire;

use App\Models\Option;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CursorStyle extends Component
{
    public function render()
    {
        if(Auth::id()){
            $cursor_style = Option::where('user_id', Auth::id())->value('cursor_style');
        }else{
            $cursor_style = "unset";
        }
        return view('livewire.cursor-style',compact('cursor_style'));
    }
}
