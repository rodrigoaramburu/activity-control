<?php

namespace App\Http\Livewire\SessionActivity;

use Livewire\Component;
use App\Models\ActivitySession;

class Delete extends Component
{

    public ActivitySession $session;

    public function mount(ActivitySession $session)
    {
        $this->session = $session;
    }

    public function render()
    {
        return view('livewire.session-activity.delete');
    }

    public function destroy()
    {
        $this->session->delete();
        $this->emit('activity-session:deleted');
    }
}
