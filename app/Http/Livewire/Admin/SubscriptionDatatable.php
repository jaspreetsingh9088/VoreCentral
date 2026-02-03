<?php

namespace App\Http\Livewire\Admin;

use App\Models\Subscription;
use Livewire\Component;
use Livewire\WithPagination;

class SubscriptionDatatable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['SubscriptionDatatableRefresh' => '$refresh'];

    public $search = '';
    public $Subscription;
    public function render()
    {
        return view('livewire.admin.subscription-datatable',  ['subscription' => Subscription::search('title', $this->search)->paginate(config('constants.pg_default', 10))]);
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
