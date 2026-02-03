<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RevenueAdminController extends Controller
{

    public function index()
    {
        // Cache Time
        $cache_time = config('cache.time');

        $currentYear = date('Y');
        $currentMonth = date('m');

        $creators = Cache::remember('revenue_creators', $cache_time, function () {

            $revenue_creators = User::join('paidcontents', 'users.id', '=', 'paidcontents.user_id')
                ->join('cart_items', 'paidcontents.id', '=', 'cart_items.paidcontent_id')
                ->join('carts', 'cart_items.cart_id', '=', 'carts.id')
                ->where('carts.paid_status', 1)
                ->groupBy('users.id')
                ->orderByDesc(DB::raw('SUM(cart_items.price * cart_items.quantity)'))
                ->select('users.username', 'users.email', DB::raw('SUM(cart_items.price * cart_items.quantity) as total_amount'))
                ->limit(5)
                ->get();

            return $revenue_creators;
        });

        $monthlyTotals = Cache::remember('revenue_monthlyTotals', $cache_time, function () use ($currentYear) {

            $revenue_monthlyTotals = DB::table('carts')
                ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
                ->select(
                    DB::raw('MONTHNAME(carts.created_at) as month'),
                    DB::raw('SUM(cart_items.price * cart_items.quantity) as total_amount')
                )
                ->whereYear('carts.created_at', $currentYear)
                ->where('carts.paid_status', 1)
                ->groupBy('month')
                ->get();

            return $revenue_monthlyTotals;
        });

        $totalAmount = Cache::remember('revenue_totalAmount', $cache_time, function () {

            $revenue_totalAmount = DB::table('carts')
                ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
                ->where('carts.paid_status', 1)
                ->sum(DB::raw('cart_items.price * cart_items.quantity'));

            return $revenue_totalAmount;
        });

        $currentMonthSales = Cache::remember('revenue_currentMonthSales', $cache_time, function () use ($currentMonth, $currentYear) {

            $revenue_currentMonthSales = DB::table('carts')
                ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
                ->join('paidcontents', 'cart_items.paidcontent_id', '=', 'paidcontents.id')
                ->where('carts.paid_status', 1)
                ->whereMonth('carts.created_at', $currentMonth)
                ->whereYear('carts.created_at', $currentYear)
                ->sum(DB::raw('cart_items.price * cart_items.quantity'));

            return $revenue_currentMonthSales;
        });

        $previousMonthSales = Cache::remember('revenue_previousMonthSales', $cache_time, function () use ($currentMonth, $currentYear) {

            $revenue_previousMonthSales = DB::table('carts')
                    ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
                    ->join('paidcontents', 'cart_items.paidcontent_id', '=', 'paidcontents.id')
                    ->where('carts.paid_status', 1)
                    ->whereMonth('carts.created_at', $currentMonth == 1 ? 12 : $currentMonth - 1)
                    ->whereYear('carts.created_at', $currentYear)
                    ->sum(DB::raw('cart_items.price * cart_items.quantity'));

            return $revenue_previousMonthSales;
        });

        $percentageGrowth = ($currentMonthSales - $previousMonthSales) / ($previousMonthSales > 0 ? $previousMonthSales : 1) * 100;

        $users = Cache::remember('revenue_users', $cache_time, function () {

            $revenue_users = User::join('carts', 'users.id', '=', 'carts.user_id')
                ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
                ->select('users.id', 'users.username', 'users.email', DB::raw('SUM(cart_items.price * cart_items.quantity) as total'))
                ->where('carts.paid_status', 1)
                ->groupBy('users.id', 'users.username')
                ->orderByDesc('total')
                ->limit(5)
                ->get();

            return $revenue_users;
        });

        return view('admin.revenue.index', compact('creators', 'users', 'monthlyTotals', 'totalAmount', 'percentageGrowth'));
    }
}
