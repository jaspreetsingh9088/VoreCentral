<?php

namespace App\Http\Livewire\Admin\Layouts;

use App\Models\Tab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class SidebarList extends Component
{
    public function render(Request $request)
    {
        $tabs = Cache::remember('sidebar-tabs_' . Auth::id(), 60 * 60, function () {
            $all = Tab::query();
            if (isset(Auth::user()->role_id)) {
                $all = $all->whereHas('visibletabs', function ($q) {
                    $q->where('role_id', Auth::user()->role_id)
                        ->where('visible', 1);
                })->orWhere('url', 'admindashboard')->where('url', '<>', 'section');
            }
            $all = $all->with(['tabs'])->get();
            return $all;
        });

        return view('livewire.admin.layouts.sidebar-list', ['tabs' => $tabs]);
    }
}
