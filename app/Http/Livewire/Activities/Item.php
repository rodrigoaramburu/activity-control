<?php

namespace App\Http\Livewire\Activities;

use Livewire\Component;
use App\Models\Activity;
use App\Http\Livewire\Activities\Edit;

class Item extends Component
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
        return view('livewire.activities.item');
    }

    public function edit()
    {
        $this->emitTo(Edit::class,'activity.edit:show', $this->activity);
    }

}
