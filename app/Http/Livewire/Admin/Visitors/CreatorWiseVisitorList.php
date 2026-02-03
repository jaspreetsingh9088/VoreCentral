<?php

namespace App\Http\Livewire\Admin\Visitors;

use App\Models\TrackUserVisit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreatorWiseVisitorList extends Component
{
    public $creator_id = null;
    public $start_date = null;
    public $end_date = null;

    public function updatedCreatorId()
    {
        $this->emit('reset-select2');
    }

    public function render()
    {
        $creators = User::where('creator', true)->get();
        $visitors = TrackUserVisit::query();
        if (isset($this->start_date, $this->end_date)) {
            $visitors = $visitors->whereBetween("created_at", [$this->start_date, $this->end_date]);
        }
        if (isset($this->creator_id)) {
            $visitors = $visitors->where("creator_id", $this->creator_id);
        }
        $visitors = $visitors->select('creator_id', DB::raw('count(*) as visits_count'))
            ->groupBy('creator_id')
            ->with(["user"])->paginate(config('constants.pg_default', 10));
        return view('livewire.admin.visitors.creator-wise-visitor-list', compact('visitors', 'creators'));
    }
}
