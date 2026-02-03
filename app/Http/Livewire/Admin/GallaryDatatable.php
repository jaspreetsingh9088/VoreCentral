<?php

namespace App\Http\Livewire\Admin;

use App\Models\Usercontent;
use Livewire\Component;
use Livewire\WithPagination;

class GallaryDatatable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['GallaryDatatableRefresh' => '$refresh'];

    public $search = '';
    public $Gallary;

    public function render()
    {
        $gallery = Usercontent::search('usercontents.id', $this->search)->join('users', 'usercontents.userid', '=', 'users.id')
            ->select('usercontents.*', 'users.username')
            ->withCount('like', 'dislike')
            ->paginate(config('constants.pg_default', 10));

        return view('livewire.admin.gallary-datatable', ['gallary_item' => $gallery]);
    }

    // public function destory($id)
    // {
    //     $this->deleteId = $id;
    //     // dd($id);
    //     // $subscription = Subscription::findOrFail($id);
    //     // $subscription->delete();
    //     // $this->resetPage();

    // }

    public function delete()
    {
        Usercontent::find($this->deleteId)->delete();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
