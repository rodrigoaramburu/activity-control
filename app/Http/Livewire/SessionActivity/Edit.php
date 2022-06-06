<?php

namespace App\Http\Livewire\SessionActivity;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Activity;
use App\Models\ActivitySession;

class Edit extends Component
{

    public bool $show = false;
    
    public ?ActivitySession $activitySession;

    public ?string $begin = null;
    public ?string $end = null;

    protected $listeners = [
        'session.edit:show' => 'show',
        'session.edit:hidden' => 'hidden',
    ];

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


    public function mount(ActivitySession $activitySession)
    {
        $this->activitySession = $activitySession;
    }

    public function render()
    {
        return view('livewire.session-activity.edit',[
            'activities' => Activity::orderBy('name')->get()
        ]);
    }

    public function show(ActivitySession $activitySession)
    {
        $this->activitySession = $activitySession;
        $this->show = true;

        $this->begin = $this->activitySession->begin->format('Y-m-d\TH:i:s');
        $this->end = $this->activitySession->end->format('Y-m-d\TH:i:s');

    }

    public function update()
    {
        sleep(6);
        $this->activitySession->begin = Carbon::parse($this->begin);
        $this->activitySession->end = Carbon::parse($this->end);
        
        $this->validate();
        $this->activitySession->update();

        $this->activitySession = null;
        $this->show = false;
        $this->emitTo(ListSessions::class,'activity-session:updated');
    }

    public function hidden()
    {
        $this->show = false;
    }
    
}
