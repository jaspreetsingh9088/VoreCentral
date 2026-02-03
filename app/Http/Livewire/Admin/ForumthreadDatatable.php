<?php

namespace App\Http\Livewire\Admin;

use App\Models\Subscription;
use App\Models\Forumcategory;
use Livewire\Component;
use Livewire\WithPagination;

class ForumthreadDatatable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['ForumcategoriesDatatableRefresh' => '$refresh'];

    public $search = '';
    public $Forumcategory;
    public function render()
    {
        return view('livewire.admin.forumthread-datatable',  ['forumcategories' => Forumcategory::search('name', $this->search)->paginate(config('constants.pg_default', 10))]);
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
