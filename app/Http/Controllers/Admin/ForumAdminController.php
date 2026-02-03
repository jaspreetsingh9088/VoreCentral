<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forumcategory;
use App\Traits\ApiResponse;
use App\Traits\CheckPermissionTrait;
use Illuminate\Http\Request;
use App\Models\Forumheading;

class ForumAdminController extends Controller
{
    use ApiResponse, CheckPermissionTrait;

    public function index()
    {
        $forumheadingData = Forumheading::get()->toArray();
        return view('admin.forum.index', compact('forumheadingData'));
    }

    public function store(Request $request)
    {
        if (!$this->checkRoutePermission('add')) return redirect()->back()->with('unathorized');
        $request->validate([
            'name' => 'required|unique:forumcategories|min:3|max:255',
        ]);
        Forumcategory::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'hid' => $request['hid'],
        ]);
        return $this->sendResponse('Forumcategory created succesfully.', 200);
    }

    public function show($id)
    {

    }

    public function edit(Forumcategory $Forumcategory)
    {
        if (!$this->checkRoutePermission('update')) return redirect()->back()->with('unathorized');
        $data['url'] = route('admin.forumcategory.update', $Forumcategory);
        $data['html'] = (string)view('admin.forum.edit', compact('Forumcategory'));
        return $this->sendResponse('Role edit page load successfully.', 200, $data);
    }

    public function update(Request $request, Forumcategory $Forumcategory)
    {
        if (!$this->checkRoutePermission('update')) return redirect()->back()->with('unathorized');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:forumcategories,name,' . $Forumcategory->id,
        ]);
        $Forumcategory->update([...$request->only('name', 'description')]);
        return $this->sendResponse('Role updated succesfully.', 200);
    }

    public function destroy($id)
    {
        $Forumcategory = Forumcategory::where('id', $id)->first();
        $Forumcategory->delete();
        return redirect()->back()->with('Forum category delete succesfully');
    }
}
