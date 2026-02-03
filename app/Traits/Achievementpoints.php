<?php

namespace App\Traits;
use App\Models\Achievementpoint;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
trait Achievementpoints
{
    public function PointInsert($content_id,$pagename,$point,$pageno){
        if($pagename != 'follow'){
            $userid = Auth::id();
        }else{
            $userid = $content_id;
        }
        $achi_point = Achievementpoint::where('content_id',$content_id)->where('user_id',$userid)->where('page',$pagename)->where('page_no',$pageno)->count();
        if($achi_point == 0){
            if($pagename != 'follow'){
                Auth::user()->increment('points', $point);
            }else{
                $user = User::where('id',$userid)->first();
                $user->points += $point;
                $user->save();
            }
            $archivement = Achievementpoint::insert([
                'user_id'       => $userid,
                'content_id'    => $content_id,
                'page'          => $pagename,
                'point'         => $point,
                'page_no'       => $pageno
            ]);
            return $archivement;
        }else{
            return $achi_point;
        }
    }

    public function OwnEarnPoint($user_id,$content_id,$pagename,$point,$pageno,$visitor_id = null){
        if($pagename == 'own gallert content views'){
            $achi_point = Achievementpoint::
                            where('user_id',$user_id)
                            ->where('visitor_id',$visitor_id)
                            ->where('content_id',$content_id)
                            ->where('page',$pagename)
                            ->where('page_no',$pageno)
                            ->count();
            $archivement = Achievementpoint::where('user_id',$user_id)->where('visitor_id',$visitor_id)->where('content_id',$content_id)->where('page',$pagename)->where('page_no',$pageno)->first();
        }else{
            $achi_point = 0;
        }
        if($achi_point == 0){
            $user = User::where('id',$user_id)->first();
            $user->points += $point;
            $user->save();

            $archivement = Achievementpoint::insert([
                'user_id'       => $user_id,
                'visitor_id'    => $visitor_id,
                'content_id'    => $content_id,
                'page'          => $pagename,
                'point'         => $point,
                'page_no'       => $pageno
            ]);
        }
        return $archivement;
    }


    public function PointInsertEveryTime($pagename,$point,$pageno,$content_id = null){
        $archivement = Achievementpoint::insert([
            'user_id'       => Auth::id(),
            'content_id'       => $content_id,
            'page'          => $pagename,
            'point'         => $point,
            'page_no'       => $pageno
        ]);
        Auth::user()->increment('points', $point);
        return $archivement;
    }

    public function LoginPointInsert(){
        $point = Achievementpoint::where('user_id',Auth::id())->where('page','login')->whereDate('created_at', Carbon::today())->count();
        if($point == 0){
            $archivement = Achievementpoint::insert([
                'user_id'       => Auth::id(),
                'content_id'    => 0,
                'page'          => 'login',
                'point'         => 0.1,
                'page_no'       => 1
            ]);
            Auth::user()->increment('points', 0.1);
            return $archivement;
        }else{
            return $point;
        }
    }
    /*
        webstore content upload     => UserController > saveMonetizeUpload *

        own gallery content like        => CreatorController > marklike *
        own gallery content dislike     => CreatorController > markdislike *
        own gallery content comment     => CreatorController > addgallerycomment *
        own gallery content favorite    => CreatorController > markgalleryfavorite *
        own gallert content views        => CreatorController > contentdetail *

        gallery content upload      => UserController > uploadcontent *
        gallery content like        => CreatorController > marklike *
        gallery content dislike     => CreatorController > markdislike *
        gallery content comment     => CreatorController > addgallerycomment *
        gallery content favorite    => CreatorController > markgalleryfavorite *
        content details             => CreatorController > contentdetail *

        dlc                         => UserController  > dlc *
        dlc content upload          => UserController > uploaddlccontent *
        dlc content like            => UserController > likedlc *
        dlc content dislike         => UserController > dislikedlc *

        added thread comment        => ForumController > addthreadcomment *
        thread comment like         => ForumController > threadCommentLike *
        thread comment dislike      => ForumController > threadCommentDislike *
        thread comment reply        => ForumController > quotesmessage *
        thread                      => ForumController > index *
        Added forum post            => ForumController > createthread *
        thread detail               => ForumController > threaddetail *

        follow                      => ProfileController > follow *
        profile post like           => ProfileController > like *
        profile post reply          => ProfileController > addcomment *

        content promoted            => DashboardController > contentPromotedProduced *

        gallery featured              => UserController > featured *
        gallery latest                => UserController > featured *
        gallery recency               => UserController > recency *
        gallery relevancy             => UserController > publicgallery *
        gallery random                => UserController > randomGallery *
        gallery prioritise tags       => UserController > prioritiseTags *
        gallery prioritise popularity => UserController > prioritisePopularity *

        gallery literatures latest                 => UserController > getFilterData *
        gallery literatures featured               => UserController > getFilterData *
        gallery literatures prioritise popularity  => UserController > getFilterData *
        gallery literatures relevancy              => UserController > getFilterData *
        gallery literatures prioritise tags        => UserController > getFilterData *
        gallery literatures random                 => UserController > getFilterData *
        gallery literatures recency                => UserController > getFilterData *

        gallery pictures latest                 => UserController > getFilterData *
        gallery pictures featured               => UserController > getFilterData *
        gallery pictures prioritise popularity  => UserController > getFilterData *
        gallery pictures relevancy              => UserController > getFilterData *
        gallery pictures prioritise tags        => UserController > getFilterData *
        gallery pictures random                 => UserController > getFilterData *
        gallery pictures recency                => UserController > getFilterData *

        gallery comics latest                 => UserController > getFilterData *
        gallery comics featured               => UserController > getFilterData *
        gallery comics prioritise popularity  => UserController > getFilterData *
        gallery comics relevancy              => UserController > getFilterData *
        gallery comics prioritise tags        => UserController > getFilterData *
        gallery comics random                 => UserController > getFilterData *
        gallery comics recency                => UserController > getFilterData *

        gallery videos latest  => UserController > getFilterData *
        gallery videos featured  => UserController > getFilterData *
        gallery videos prioritise popularity  => UserController > getFilterData *
        gallery videos relevancy  => UserController > getFilterData *
        gallery videos prioritise tags  => UserController > getFilterData *
        gallery videos random  => UserController > getFilterData *
        gallery videos recency  => UserController > getFilterData *

        gallery games latest  => UserController > getFilterData *
        gallery games featured  => UserController > getFilterData *
        gallery games prioritise popularity  => UserController > getFilterData *
        gallery games relevancy  => UserController > getFilterData *
        gallery games prioritise tags  => UserController > getFilterData *
        gallery games random  => UserController > getFilterData *
        gallery games recency  => UserController > getFilterData *

        gallery audio latest  => UserController > getFilterData *
        gallery audio featured  => UserController > getFilterData *
        gallery audio prioritise popularity  => UserController > getFilterData *
        gallery audio relevancy  => UserController > getFilterData *
        gallery audio prioritise tags  => UserController > getFilterData *
        gallery audio random  => UserController > getFilterData *
        gallery audio recency  => UserController > getFilterData *


    */
}
?>
