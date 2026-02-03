<?php

namespace App\Http\Livewire\Admin;

use App\Models\Subscription;
use App\Models\Forumheading;
use Livewire\Component;
use Livewire\WithPagination;

class ForumheadingsDatatable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['ForumheadingsDatatableRefresh' => '$refresh'];

    public $search = '';
    public $Forumheading;
    public function render()
    {
        return view('livewire.admin.forumheadings-datatable',  ['forumheadings' => Forumheading::search('name', $this->search)->paginate(config('constants.pg_default', 10))]);
    }

    public function destory($id)
    {
        $this->deleteId = $id;
        // dd($id);
        // $subscription = Subscription::findOrFail($id);
        // $subscription->delete();
        // $this->resetPage();
    }

        public function delete()
        {
           Subscription::find($this->deleteId)->delete();
        }
}
