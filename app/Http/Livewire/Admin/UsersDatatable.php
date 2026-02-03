<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersDatatable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function render()
    {
        return view('livewire.admin.users-datatable', ['users' => User::search('username', $this->search)->paginate(config('constants.pg_default', 10))]);
    }
}
