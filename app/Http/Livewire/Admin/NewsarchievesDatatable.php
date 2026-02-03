<?php

namespace App\Http\Livewire\Admin;

use App\Models\Newsarchive;
use Livewire\Component;
use Livewire\WithPagination;

class NewsarchievesDatatable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['NewsarchievesDatatableRefresh' => '$refresh'];

    public $search = '';
    public $Newsarchive;
    public function render()
    {
        $newsarchive = Newsarchive::search('id', $this->search)
            ->orderBy('id', 'DESC')
            ->paginate(config('constants.pg_default', 10));

        return view('livewire.admin.newsarchive-datatable',  ['newsarchive' => $newsarchive]);
    }

    // public function destory($id)
    // {
    //     $this->deleteId = $id;
    //     // dd($id);
    //     // $subscription = Subscription::findOrFail($id);
    //     // $subscription->delete();
    //     // $this->resetPage();

    // }

    public function destory($id)
    {
        $newsarchive = Newsarchive::findOrFail($id);
        $newsarchive->delete();
        $this->resetPage();
    }
}
