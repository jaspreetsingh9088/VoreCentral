<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreatorWiseVisitorAdminController extends Controller
{
    public function index()
    {
        return view('admin.creator-wise-visitors.index');
    }
}
