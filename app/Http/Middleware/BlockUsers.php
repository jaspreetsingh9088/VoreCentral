<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Blockuser;

class BlockUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        if(Auth::check()){
            $blockuser = Blockuser::where('block_by',Auth::id())->pluck('block_to')->toArray();
            $segment = $request->segments(); 
            if(isset($segment[0])){
                if($segment[0] != Auth::id()){
                    $user = User::where('id',$segment[0])->first();
                    if(!is_null($user)){
                        if(in_array($segment[0],$blockuser)){
                            return redirect()->back()->with('successful_message','You will block this user');
                        }else{
                            $blockyou = Blockuser::where('block_to',Auth::id())->pluck('block_by')->toArray();
                            if(in_array($segment[0],$blockyou)){
                                return redirect()->back()->with('successful_message','This user has blocked you');
                            }else{
                                return $next($request);
                            }
                        }
                    }else{
                        return redirect()->back()->with('successful_message','This user not found');
                    }
                }else{
                    return $next($request);
                }
            }else{
                return redirect()->back()->with('successful_message','This user not found');
            }
        }
    }
}
