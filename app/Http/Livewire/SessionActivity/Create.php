<?php

namespace App\Http\Livewire\SessionActivity;

use Livewire\Component;
use App\Models\Activity;
use App\Models\ActivitySession;

class Create extends Component
{

    public bool $showCreate = false;
    public bool $showCronometer = false;

    public ?string $begin = null;
    public ?string $end = null;
    public int $activity_id = 1; 
    public string $description = '';

    public function render()
    {
        $activities = Activity::orderBy('name')->get();
        return view('livewire.session-activity.create', compact('activities'));
    }

    public function openCreate()
    {
        $this->showCreate = true;
    }

    public function hiddenCreate()
    {
        $this->showCreate = false;
    }

    public function openCronometer()
    {
        $this->showCronometer = true;
    }

    public function hiddenCronometer()
    {
        $this->showCronometer = false;
    }


    public function save(): void
    {
        ActivitySession::create([
            'begin' => $this->begin,
            'end' => $this->end,
            'activity_id' => $this->activity_id,
            'description' => $this->description,
        ]);

        $this->emit('activity-session:created');
        $this->reset([
            'showCreate',
            'showCronometer',
            'begin',
            'end',
            'activity_id',
            'description',
        ]);
    }


}
