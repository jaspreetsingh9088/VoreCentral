<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Traits\CheckPermissionTrait;
use Illuminate\Http\Request;

class VisitorAdminController extends Controller
{
    use ApiResponse, CheckPermissionTrait;

    public function index()
    {
        return view('admin.visitors.index');
    }
}
