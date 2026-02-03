<?php

namespace App\Http\Controllers\Admin;

use App\Enum\TabTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Tab;
use App\Models\Visibletab;
use App\Traits\ApiResponse;
use App\Traits\CheckPermissionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleAdminController extends Controller
{
    use ApiResponse, CheckPermissionTrait;
    public function index()
    {
        return view('admin.roles.index');
    }

    public function store(Request $request)
    {
        if (!$this->checkRoutePermission('add'))  return redirect()->back()->with('unathorized');
        $request->validate([
            'name' => 'required|unique:roles|max:255|min:3',
        ]);
        Role::create(array_merge($request->only('name'), ['admin_id' => Auth::id()]));
        return $this->sendResponse('Role created succesfully.', 200);
    }

    public function edit(Role $role)
    {
        if (!$this->checkRoutePermission('update'))  return redirect()->back()->with('unathorized');
        $data['url'] = route('admin.roles.update', $role);
        $data['html'] = (string) view('admin.roles.edit', compact('role'));
        return $this->sendResponse('Role edit page load successfully.', 200, $data);
    }

    public function update(Request $request, Role $role)
    {
        if (!$this->checkRoutePermission('update'))  return redirect()->back()->with('unathorized');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:roles,name,' . $role->id,
        ]);
        $role->update($request->only('name'));
        return $this->sendResponse('Role updated succesfully.', 200);
    }

    public function show(Role $role)
    {
        $authtabs = Visibletab::where('role_id', Auth::user()->role_id)->get();
        $rolevisibles = Visibletab::where('role_id', $role->id)->get();
        $tabs = Tab::whereNot('type', TabTypeEnum::TABMAIN);
        if (Auth::user()->role_id != null) $tabs = $tabs->whereIn('id', $authtabs->pluck('tab_id'));
        $tabs = $tabs->whereNot('url', 'dashboard')->get();
        $data['url'] =  route('admin.roles.visibletabs', $role);
        $data['html'] = (string) view('admin.roles.visibletab', compact('role', 'tabs', 'rolevisibles', 'authtabs'));
        return $this->sendResponse('Tabs list load successfully.', 200, $data);
    }

    public function VisibleTab(Request $request, Role $role)
    {
        if (isset($request->tab) && sizeof($request->tab) > 0) {
            Visibletab::where('role_id', $role->id)
                ->whereNotIn('tab_id', array_keys($request->tab))
                ->delete();
            foreach ($request->tab as $tab => $value) {
                $current = Tab::where('id', $tab)->first();
                $array = [
                    'visible'       => 1,
                    'add_row'       => 1,
                    'update_row'    => 1,
                    'delete_row'    => 1,
                ];
                if (isset($current->tab_id)) {
                    Visibletab::updateOrCreate([
                        'role_id'   => $role->id,
                        'tab_id'    => $current->tab_id
                    ], $array);
                }

                $array['visible']       = isset($value['visible']) ? 1 : 0;
                $array['add_row']       = isset($value['add']) ? 1 : 0;
                $array['update_row']    = isset($value['update']) ? 1 : 0;
                $array['delete_row']    = isset($value['delete']) ? 1 : 0;

                Visibletab::updateOrCreate([
                    'role_id'   => $role->id,
                    'tab_id'    => $tab
                ], $array);
            }
        }

        return $this->sendResponse("Role Permissions Updated successfully.", 200);
    }
}
