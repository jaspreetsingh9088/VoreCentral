<?php

namespace App\Http\Livewire\Admin\Common;

use Livewire\Component;

class ToogleButton extends Component
{
    public $data;
    public $status = false;
    public function mount($data)
    {
        $this->data = $data;
        $this->status = $data->status;
    }

    public function changeStatus()
    {
        $this->status = !$this->status;
        $this->data->status = $this->status;
        $this->data->save();
        $this->emit('ToogleButtonRefresh');
    }

    public function render()
    {
        return view('livewire.admin.common.toogle-button');
    }
}
