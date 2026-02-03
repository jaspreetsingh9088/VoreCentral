<?php

namespace App\View\Components\Admin\Common;

use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class RoleCheck extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $type = 'add';

    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $checkper = false;
        $permission = Session::get('permission');
        $livewire_check = request()->segment(1);
        if ($livewire_check === "livewire") {
            $previous_segment = explode('/', url()->previous());
            $segment = $previous_segment[4];
        } else {
            $segment = request()->segment(config('constants.url_segment'));
        }

        foreach ($permission as $per => $value) {
            switch ($this->type) {
                case 'delete':
                    if ($per == $segment && $value['delete']) {
                        $checkper = true;
                    }
                    break;
                case 'update':
                    if ($per == $segment && $value['update']) {
                        $checkper = true;
                    }
                    break;
                default:
                    if ($per == $segment && $value['add']) {
                        $checkper = true;
                    }
                    break;
            }
        }
        return view('components.admin.common.role-check', ['checkper' => $checkper]);
    }
}
