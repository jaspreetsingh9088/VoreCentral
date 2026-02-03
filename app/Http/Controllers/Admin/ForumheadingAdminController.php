<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use App\Models\Forumcategory;
use App\Models\Forumheading;

use App\Traits\ApiResponse;

use App\Traits\CheckPermissionTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ForumheadingAdminController extends Controller

{

    use ApiResponse, CheckPermissionTrait;

    public function index()

    {

        return view('admin.forumheading.index');

    }



    public function store(Request $request)

    {

        if (!$this->checkRoutePermission('add'))  return redirect()->back()->with('unathorized');

        $request->validate([

            'name' => 'required|unique:forumcategories|min:3|max:255',

        ]);

        Forumheading::create($request->only('name'));

        return $this->sendResponse('Forumheading created succesfully.', 200);

    }



    public function edit(Forumheading $Forumheading)

    {

        if (!$this->checkRoutePermission('update'))  return redirect()->back()->with('unathorized');

        $data['url'] = route('admin.forumheading.update', $Forumheading);

        $data['html'] = (string) view('admin.forumheading.edit', compact('Forumheading'));

        return $this->sendResponse('Forum edit page load successfully.', 200, $data);

    }



    public function update(Request $request, Forumheading $Forumheading)

    {

        if (!$this->checkRoutePermission('update'))  return redirect()->back()->with('unathorized');

        $request->validate([

            'name' => 'required|max:255|min:3|unique:forumcategories,name,' . $Forumheading->id,

        ]);

        $Forumheading->update([...$request->only('name')]);

        return $this->sendResponse('Forum heading updated succesfully.', 200);

    }

    public function delete($id)
    {
        if (Forumheading::where('id', $id)->exists()) {

            // Forum Category delete
            Forumcategory::where('hid', $id)->delete();

            // Forum heading delete
            Forumheading::where('id', $id)->delete();
            
            Session::flash('success', 'Forum heading deleted successfully.');

        } else {

            Session::flash('error', 'Forum heading not found.');
        }

        return redirect()->back();
    }

}

