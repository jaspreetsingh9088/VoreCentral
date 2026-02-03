<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Models\User;
use Livewire\Component;

class ModeratorEmailBoxEmployeeAdminLivewire extends Component
{
    public $type = "normal";
    public $selected_user = null;
    public $selected_name = null;



    public function render()
    {
        $users = User::select('email')->get();
        return view('livewire.admin.employee.moderator-email-box-employee-admin-livewire', compact('users'));
    }
}
