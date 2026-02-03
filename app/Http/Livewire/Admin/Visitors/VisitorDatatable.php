<?php

namespace App\Http\Livewire\Admin\Visitors;

use App\Models\TrackUserVisit;
use Livewire\Component;
use Livewire\WithPagination;

class VisitorDatatable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['VisitorDatatableRefresh' => '$refresh'];
    public $search = '';

    public function render()
    {
        $visitors = TrackUserVisit::latest()->with(["user"])->paginate(config('constants.pg_default', 10));
        return view('livewire.admin.visitors.visitor-datatable', compact('visitors'));
    }
}
