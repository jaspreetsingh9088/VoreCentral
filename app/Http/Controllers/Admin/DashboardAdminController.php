<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usercontent;
use App\Models\Paidcontent;
use App\Models\User;
use App\Models\Creator;
use App\Traits\ApiResponse;
use App\Traits\CheckPermissionTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Cache Time
        $cache_time = config('cache.time');

        $user = User::count();
        $creatorcontent = Creator::where('status','=',1)->count();
        $paidcontent = Paidcontent::count();
        $usercontent = Usercontent::count();

        $user_area_chart = Cache::remember('dashboard_user_chart', $cache_time, function () {

            $user_chart = User::select(DB::raw('MONTHNAME(created_at) as month_name'),
                DB::raw('COUNT(CASE WHEN creator = 1 THEN 1 ELSE NULL END) as new_creators'),
                DB::raw('COUNT(CASE WHEN creator = 0 THEN 1 ELSE NULL END) as new_users'),
                DB::raw('MONTH(created_at) as month_number')
            )
                ->whereYear('created_at', now('Y'))
                ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('MONTHNAME(created_at)'))
                ->orderBy('month_number')
                ->get();

            return $user_chart;
        });

        $creator_bar_chart = Cache::remember('dashboard_creator_chart', $cache_time, function () {

            $creator_chart = Usercontent::select(
                DB::raw('MONTHNAME(created_at) as month_name'),
                DB::raw('COUNT(*) as content_count'),
                DB::raw('MONTH(created_at) as month_number')
            )
                ->whereYear('created_at', now()->year)
                ->groupBy('month_name', 'month_number')
                ->orderBy('month_number')
                ->get();

            return $creator_chart;
        });

        $paid_bar_chart = Cache::remember('dashboard_paid_chart', $cache_time, function () {

            $paid_chart = Paidcontent::select(
                DB::raw('MONTHNAME(created_at) as month_name'),
                DB::raw('COUNT(*) as content_count'),
                DB::raw('MONTH(created_at) as month_number')
            )
                ->whereYear('created_at', now()->year)
                ->groupBy('month_name', 'month_number')
                ->orderBy('month_number')
                ->get();

            return $paid_chart;
        });

        return view('admin.dashboard', compact('user', 'usercontent', 'paidcontent', 'creatorcontent', 'user_area_chart', 'creator_bar_chart', 'paid_bar_chart'));
    }
}
