<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeesDatatable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['EmployeesDatatableRefresh' => '$refresh'];

    public $search = '';

    public function render()
    {
        $employees = Admin::search('name', $this->search)->employee();
        if (Auth::user()->admin_id != null) $employees = $employees->myEmployee();
        $employees = $employees->with(['parent', 'role', 'user' => function ($q) {
            $q->select('email');
        }])->paginate(config('constants.pg_default', 10));
        return view('livewire.admin.employees-datatable', ['employees' => $employees]);
    }

    public function destory(Admin $admin)
    {
        if ($admin->admin_id == Auth::id()) {
            $admin->delete();
            $this->resetPage();
        }
    }
}
