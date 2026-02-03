<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\User;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Point;
use Log;
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */

        public function boot()
        {
         
            View::composer('*', function ($view) {
                if(Auth::check()){
                    $id = Auth::id();

                }
                else{
                    $id="";
                }
                $profile_rank = null;
                $Pointcount = Point::where('userid', $id)->sum('point');
                if ($id) {
                    $myData = User::where('id', $id)->get()->toArray();
    
                    if (!empty($myData)) {
                        $controller = new Controller();
                        $user = $myData[0];
                        if ($user['role_preference'] == 'pred') {
                            if (is_null($user['achievements']) || $user['achievements'] == 'null') {
                                $profile_rank = $controller->achivements($user['role_preference'], $Pointcount);
                            } else {
                                $rank = json_decode($user['achievements']);
                                $profile_rank = $user['achievements'];
                            }
                        } elseif ($user['role_preference'] == 'prey') {
                            if (is_null($user['prey_achievements']) || $user['prey_achievements'] == 'null') {
                                $profile_rank = $controller->achivements($user['role_preference'], $Pointcount);
                            } else {
                                $profile_rank = $user['prey_achievements'];

                            }
                        } else {
                            $profile_rank = $user['achievements'];
                        }
                    }
                }
                $view->with('profile_rank', $profile_rank);
            });
        }
}
