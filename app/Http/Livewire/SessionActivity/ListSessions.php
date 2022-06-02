<?php

namespace App\Http\Livewire\SessionActivity;

use App\Models\Activity;
use Livewire\Component;
use App\Models\ActivitySession;

class ListSessions extends Component
{

    public ?string $activity_id_filter = null;

    protected $listeners = [
        'activity-session:created' => '$refresh',
        'activity-session:deleted' => '$refresh',
        'activity-session:updated' => '$refresh',
    ];


    public function render()
    {
        $sessions = ActivitySession::orderBy('begin', 'desc')
            ->when($this->activity_id_filter, function ($query) {
                return $query->where('activity_id', $this->activity_id_filter);
            })
            ->get();

        $activities = Activity::orderBy('name')->get();

        return view('livewire.session-activity.list-sessions', [
            'sessions' => $sessions,
            'activities' => $activities,
        ]);
    }


    public function edit()
    {

    }
}
