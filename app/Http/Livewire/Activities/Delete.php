<?php

namespace App\Http\Livewire\Activities;

use Livewire\Component;
use App\Models\Activity;

class Delete extends Component
{

    public Activity $activity;

    protected $rules = [
        'activity' => 'required'
    ];

    public function mount(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function render()
    {
        return view('livewire.activities.delete');
    }

    public function destroy()
    {
        $this->activity->delete();
        $this->emitTo(Home::class,'activity:deleted');
    }
}
