<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class TagsDatatable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['TagsDatatableRefresh' => '$refresh'];

    public $search = '';
    public $tag;
    public function render()
    {
        return view('livewire.admin.tags-datatable',  ['tags' => Tag::search('title', $this->search)->paginate(config('constants.pg_default', 10))]);
    }

    public function destory($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        $this->resetPage();
    }
}
