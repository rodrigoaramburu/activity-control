<?php

namespace App\Http\Livewire\SessionActivity;

use Livewire\Component;
use App\Models\Activity;
use App\Models\ActivitySession;

class Edit extends Component
{

    public bool $show = false;
    
    public ?ActivitySession $session;

    public ?string $begin = null;
    public ?string $end = null;
    public int $activity_id = 1; 
    public string $description = '';

    protected $listeners = [
        'session.edit:show' => 'show',
        'session.edit:hidden' => 'hidden',
    ];

    public function mount(ActivitySession $session)
    {
        $this->session = $session;
    }

    public function render()
    {
        return view('livewire.session-activity.edit',[
            'activities' => Activity::orderBy('name')->get()
        ]);
    }

    public function show(ActivitySession $session)
    {
        $this->session = $session;
        $this->show = true;
        
        $this->description = $session->description;
        $this->begin = $session->begin->format('Y-m-d\TH:i:s');
        $this->end = $session->end->format('Y-m-d\TH:i:s');
        $this->activity_id = $session->activity_id;
    }

    public function update()
    {
        $this->session->update([
            'begin' => $this->begin,
            'end' => $this->end,
            'activity_id' => $this->activity_id,
            'description' => $this->description,
        ]);

        $this->session = null;
        $this->show = false;
        $this->emitTo(ListSessions::class,'activity-session:updated');
    }

    public function hidden()
    {
        $this->show = false;
    }
    
}
