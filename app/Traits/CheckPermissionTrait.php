<?php

namespace App\Traits;

use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

trait CheckPermissionTrait
{
    public function checkRoutePermission($type)
    {
        $checkper = false;
        $permission = Session::get('permission');
        $segment = request()->segment(config('constants.url_segment'));
        if (isset($permission[$segment])) {
            switch ($type) {
                case 'delete':
                    if ($permission[$segment]['delete']) {
                        $checkper = true;
                    }
                    break;
                case 'update':
                    if ($permission[$segment]['update']) {
                        $checkper = true;
                    }
                    break;
                default:
                    if ($permission[$segment]['add']) {
                        $checkper = true;
                    }
                    break;
            }

        }
        return $checkper;
    }
}
