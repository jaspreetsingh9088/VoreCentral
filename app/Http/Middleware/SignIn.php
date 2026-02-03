<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Arr;

class SignIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()){
            return $next($request);
        }else{
            $segment = $request->segments();
            // dd($segment);
            if(count($segment)){

                if($segment[0] != 'admin'){
                    if(isset($segment[1])){
                        if($segment[1] == 'creatordashboard'){
                            $segment = 'Creator Dashboard';
                        }elseif($segment[1] == 'creatorwebstore'){
                            $segment = 'Creator Webstore';
                        }elseif($segment[1] == 'dashboard'){
                            $segment = 'Dashboard';
                        }elseif($segment[0] == 'publicstore' && $segment[1] == 'upload'){
                            $segment = 'Public Store Upload';
                        }else{
                            $segment = ucwords($segment[0]);
                        }
                    }else{
                        if(isset($segment[0])){
                            $optionpage = array('general_setting','tag_option','notification_option','technical_option','theme_option','Social_option');

                            if(in_array($segment[0],$optionpage)){
                                $explode = explode('_',$segment[0]);
                                $implode = implode(' ',$explode);
                                $segment = ucwords($implode);
                            }else{
                                $segment = ucwords($segment[0]);
                            }
                        }else{
                            $segment = ucwords($segment[0]);
                        }
                    }
                }
                return redirect()->route('user.not.login',[$segment]);
            }else{
                //return redirect()->route('admin.admindashboard');
            }
        }
    }
}
