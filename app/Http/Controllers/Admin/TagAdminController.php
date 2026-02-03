<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Traits\ApiResponse;
use App\Traits\CheckPermissionTrait;
use Illuminate\Http\Request;

class TagAdminController extends Controller
{
    use ApiResponse, CheckPermissionTrait;
    public function index()
    {
        return view('admin.tags.index');
    }

    public function store(Request $request)
    {
        if (!$this->checkRoutePermission('add'))  return redirect()->back()->with('unathorized');
        $request->validate([
            'title' => 'required|unique:tags|min:3|max:255',
        ]);
        Tag::create($request->only('title'));
        return $this->sendResponse('Category created succesfully.', 200);
    }

    public function edit(Tag $tag)
    {
        if (!$this->checkRoutePermission('update'))  return redirect()->back()->with('unathorized');
        $data['url'] = route('admin.tags.update', $tag);
        $data['html'] = (string) view('admin.tags.edit', compact('tag'));
        return $this->sendResponse('Role edit page load successfully.', 200, $data);
    }

    public function update(Request $request, Tag $tag)
    {
        if (!$this->checkRoutePermission('update'))  return redirect()->back()->with('unathorized');
        $request->validate([
            'title' => 'required|max:255|min:3|unique:tags,title,' . $tag->id,
        ]);
        $tag->update([...$request->only('title')]);
        return $this->sendResponse('Category updated succesfully.', 200);
    }
}
