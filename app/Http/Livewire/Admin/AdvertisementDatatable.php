<?php

namespace App\Http\Livewire\Admin;

use App\Models\Advertisement;
use Livewire\Component;
use Livewire\WithPagination;

class AdvertisementDatatable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['AdvertisementDatatableRefresh' => '$refresh'];

    public $search = '';
    public $Advertisement;
    public function render()
    {
        $advertisement = Advertisement::search('id', $this->search)
        ->paginate(config('constants.pg_default', 10));
        // dd($advertisement);
        return view('livewire.admin.advertisement-datatable',  ['ads_item' => $advertisement]);
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
            UserContent::find($this->deleteId)->delete();
        }
}
