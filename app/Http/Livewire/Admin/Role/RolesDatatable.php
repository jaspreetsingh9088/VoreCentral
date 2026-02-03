<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class RolesDatatable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['RolesDatatableRefresh' => '$refresh'];

    public $search = '';
    public function render()
    {
        $roles = Role::search('name', $this->search);
        $roles = $roles->myRoles();
        $roles = $roles->paginate(config('constants.pg_default', 10));
        return view('livewire.admin.role.roles-datatable', ['roles' => $roles]);
    }

    public function destory($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        $this->resetPage();
    }
}
