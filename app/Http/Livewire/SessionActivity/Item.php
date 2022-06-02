<?php

namespace App\Http\Livewire\SessionActivity;

use Livewire\Component;
use App\Models\ActivitySession;
use App\Http\Livewire\SessionActivity\Edit;
use App\Models\Activity;

class Item extends Component
{

    public ActivitySession $session;

    public function mount(ActivitySession $session)
    {
        $this->session = $session;
    }

    public function render()
    {
        return view('livewire.session-activity.item');
    }

    public function edit()
    {
        $this->emitTo(Edit::class,'session.edit:show', $this->session);
    }
}
