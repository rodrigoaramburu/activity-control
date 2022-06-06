<?php

namespace App\Http\Livewire\Reports;

use App\Models\ActivitySession;
use Livewire\Component;

class ReportHours extends Component
{
    public string $period = 'all';
         
    public $activitiesPerHour;

    public function render()
    {
        
        $activitiesSession = ActivitySession::when($this->period == 'week', function($query){
            return $query->where('begin', '>', (new \DateTime('now'))->sub( new \DateInterval('P7D'))->format('Y-m-d H:i:s') );
        })
        ->when($this->period == 'month', function($query){
            return $query->where('begin', '>', (new \DateTime('now'))->sub( new \DateInterval('P30D'))->format('Y-m-d H:i:s') );
        })->get();
        
        $this->activitiesPerHour = $activitiesSession->groupBy('activity_id')->map(function($group) {
            return [
                    'y' => $group->sum(function($item){
                        return $item->duration() /60;
                    }),
                    'x' => $group->first()->activity->name
                ];
        })->values();
        
        $this->emit('chartChange', $this->activitiesPerHour);
        return view('livewire.reports.report-hours');
    }
}
