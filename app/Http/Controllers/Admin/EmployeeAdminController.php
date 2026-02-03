<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiResponse;
use App\Traits\CheckPermissionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeAdminController extends Controller
{
    use ApiResponse, CheckPermissionTrait;

    public function index()
    {
        $admins = Admin::pluck('email');
        User::whereIn('email', $admins)->update(["moderator" => true]);
        
        return view('admin.employees.index');
    }

    public function create()
    {
        if (!$this->checkRoutePermission('add')) return redirect()->back()->with('unathorized');
        $roles = Role::query();
        if (Auth::user()->admin_id != null) $roles = $roles->myRoles();
        $roles = $roles->with(['admin'])->get();
        return view('admin.employees.create', compact('roles'));
    }

    public function store(EmployeeRequest $employeeRequest)
    {
        if (!$this->checkRoutePermission('add')) return redirect()->back()->with('unathorized');
        $admin = Admin::create(array_merge(
            $employeeRequest->validated(), [
                'password' => Hash::make($employeeRequest->password),
                'role_id' => $employeeRequest->role,
                'admin_id' => Auth::id()]
        ));

        User::where('email', $admin->email)->update(["moderator" => true]);

        return $this->sendResponse('Employee created succesfully.', 200);
    }

    public function edit(Admin $employee)
    {
        if (!$this->checkRoutePermission('update')) return redirect()->back()->with('unathorized');
        if ($employee->admin_id != Auth::id() && Auth::user()->role_id != null) abort(404);
        $roles = Role::query();
        if (Auth::user()->admin_id != null) $roles = $roles->myRoles();
        $roles = $roles->with(['admin'])->get();
        return view('admin.employees.edit', compact('employee', 'roles'));
    }

    public function update(EmployeeRequest $employeeRequest, Admin $employee)
    {
        if (!$this->checkRoutePermission('update')) return redirect()->back()->with('unathorized');

       $data = array_merge($employeeRequest->only('name', 'email'), ['role_id' => $employeeRequest->role,
            'admin_id' => Auth::id()]);

        if (isset($employeeRequest->password)) {
            $data['password'] = Hash::make($employeeRequest->password);
        }
        $employee->update($data);
        return $this->sendResponse('Employee updated succesfully.', 200);
    }
}
