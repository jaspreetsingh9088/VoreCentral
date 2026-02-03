<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CustomFileUpload;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\User;
use App\Traits\ApiResponse;
use App\Traits\CheckPermissionTrait;
use Illuminate\Support\Facades\Cache;

class AdvertisementAdminController extends Controller
{
    use CustomFileUpload;

    public function index()
    {
        return view('admin.advertisement.index');
    }


    public function create()
    {
        return view('admin.advertisement.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);

        $ad = Advertisement::create($request->all());


       /*if ($request->file('image1')) {
            $ad_content1 = $this->uploadImageFile($request->file('image1'), 'image1');
        }

        if ($request->file('image2')) {
            $ad_content2 = $this->uploadImageFile($request->file('image2'), 'image2');
        }*/

        $ad->save();


        // Removing Advertisement Item From The Cache
        Cache::forget('advertisement');


        return view('admin.advertisement.create')->with('Advertisment added succesfully');
    }

    public function updatestatus($id,$status)
    {
        $advertisement = Advertisement::find($id);
        $advertisement->status = $status;
        $advertisement->save();


        // Removing Advertisement Item From The Cache
        Cache::forget('advertisement');


        return redirect()->back()->with('Advertisement updated succesfully');
    }
}
