<?php

namespace App\Http\Livewire\SessionActivity;

use Livewire\Component;
use App\Models\Activity;
use App\Models\ActivitySession;

class Create extends Component
{

    public bool $showCreate = false;
    public bool $showCronometer = false;

    public ActivitySession $activitySession;


    protected $rules = [
        'activitySession.begin' => 'required',
        'activitySession.end' => 'required',
        'activitySession.activity_id' => 'required|integer|exists:activities,id',
        'activitySession.description' => 'string',
    ];

    protected $messages = [
        'activitySession.begin.required' => 'Informe a data e hora de início',
        'activitySession.begin.date_format' => 'Informe a data e hora de início no formato Y-m-d\TH:i',
        'activitySession.end.required' => 'Informe a data e hora de término',
        'activitySession.end.date_format' => 'Informe a data e hora de término no formato Y-m-d\TH:i',
        'activitySession.activity_id.required' => 'Informe a atividade',
        'activitySession.activity_id.integer' => 'Informe a atividade',
        'activitySession.activity_id.exists' => 'Informe a atividade',
    ];

    public function mount()
    {
        $this->activitySession = new ActivitySession([
            'begin' =>  null,
            'end' => null,
            'activity_id' => 0, 
            'description' => '',
        ]);
    }

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
        $this->validate();

        $this->activitySession->save();
        $this->emit('activity-session:created');
        $this->reset([
            'showCreate',
            'showCronometer',
        ]);
        $this->activitySession = new ActivitySession([
            'begin' =>  null,
            'end' => null,
            'activity_id' => 0, 
            'description' => '',
        ]);
    }


}
