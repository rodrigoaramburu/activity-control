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
        $this->resetErrorBag();
        $this->resetValidation();
        $this->showCronometer = true;
    }

    public function hiddenCronometer()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->showCronometer = false;
    }


    public function save(): void
    {

        $this->validate([
            'begin' => 'required|date_format:Y-m-d\TH:i',
            'end' => 'required|date_format:Y-m-d\TH:i',
            'activity_id' => 'required|integer|exists:activities,id',
        ],[
            'begin.required' => 'Informe a data e hora de início',
            'begin.date_format' => 'Informe a data e hora de início no formato Y-m-d\TH:i',
            'end.required' => 'Informe a data e hora de término',
            'end.date_format' => 'Informe a data e hora de término no formato Y-m-d\TH:i',
            'activity_id.required' => 'Informe a atividade',
            'activity_id.integer' => 'Informe a atividade',
            'activity_id.exists' => 'Informe a atividade',
        ]);

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
