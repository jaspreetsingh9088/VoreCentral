<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Point ;
use App\Models\ThemeOption;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function themes($page,$themename = null){
        if($page == 'homepage'){
            if(Auth::id()){
                $homepage_theme = ThemeOption::where('user_id',Auth::id())->value('homepage_theme');
            }else{
                $homepage_theme = 'blue_theme';
            }
            return $homepage_theme;
        }else if($page == 'gallery_theme'){
            if(Auth::id()){
                $gallery_theme = ThemeOption::where('user_id',Auth::id())->value('gallery_theme');
            }else{
                $gallery_theme = 'green_theme';
            }
            return $gallery_theme;
        }else if($page == 'forum_theme'){
            if(Auth::id()){
                $forum_theme = ThemeOption::where('user_id',Auth::id())->value('forums_theme');
            }else{
                $forum_theme = 'orange_theme';
            }
            return $forum_theme;
        }else if($page == 'others_theme'){
            if(Auth::id()){
                $others_theme = ThemeOption::where('user_id',Auth::id())->value('others_theme');
            }else{
                $others_theme = $themename;
            }
            return $others_theme;
        }
    }

    public function addpoint($userid,$point,$remark){
        $Point = new Point;
        $Point->userid = $userid ;
        $Point->point  = $point ;
        $Point->remark = $remark ;
        $Point->save();
    }

    public function achivements($type,$value){
        if($type=="pred"){
            $badge = "Maiden";
            if(($value > 5) && ($value < 30)) {
                $badge = "Madame";
            }elseif(($value > 29) && ($value < 100)) {
                $badge = "Lady";
            }
            elseif(($value > 99) && ($value < 250)) {
                $badge = "Countess";
            }
            elseif(($value > 249) && ($value < 500)) {
                $badge = "Baroness";
            }
            elseif(($value > 499) && ($value < 501)) {
                $badge = "Duchess";
            }
            elseif(($value > 499) && ($value < 1001)) {
                $badge = "Princess";
            }
            elseif(($value > 999) && ($value < 4001)) {
                $badge = "Grand Princess";
            }
            elseif(($value > 3999) && ($value < 7501)) {
                $badge = "Archduchess";
            }
            elseif(($value > 7499) && ($value < 10001)) {
                $badge = "Queen";
            }
            elseif(($value > 9999) && ($value < 50001)) {
                $badge = "Empress";
            }
            return $badge ;
        }

        if($type=="prey"){

                $badge = "French fry ";
                if(($value > 0) && ($value < 6)) {
                $badge = "Chocolate Chip Cookie ";
                }elseif(($value > 4) && ($value < 31)) {
                $badge = "Cupcake";
                }
                elseif(($value > 29) && ($value < 101)) {
                $badge = "Cream Cheese Sushi Roll";
                }
                elseif(($value > 99) && ($value < 251)) {
                $badge = "BBQ Ribs Sandwich";
                }
                elseif(($value > 250) && ($value < 501)) {
                $badge = "Vanilla Strawberry Cake";
                }
                elseif(($value > 500) && ($value < 1001)) {
                $badge = "Bucket of Fried Chicken";
                }
                elseif(($value > 1000) && ($value < 4001)) {
                 $badge = "Cheeseburger-Lasagna";
                }
                elseif(($value > 4000) && ($value < 7501)) {
                 $badge = "Marzipan Icecream-Cheese-Cake";
                }
                elseif(($value > 7499) && ($value < 10001)) {
                 $badge = "Deepfried-Pizzas-With-Baconcheeseburgers-and-Icecream-and-Cheesecake-Taco-Lasagna with Chocolate-Strawberry-Honey-Buttercream-Sorbet for dessert";
                }
                elseif(($value > 9999) && ($value < 50001)) {
                 $badge = "A feast for a queen";
                }
               return $badge ;

           }
     }
}
