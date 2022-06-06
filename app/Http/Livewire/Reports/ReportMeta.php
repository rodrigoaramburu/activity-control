<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;
use App\Models\Activity;
use App\Models\ActivitySession;
use Illuminate\Support\Collection;

class ReportMeta extends Component
{

    public ?int $activity_id = null;
    public Collection $activities;
    public Collection $sessionsByDate;
    public Collection $meta;

    public function mount(){
        $this->activities = Activity::orderBy('name')->get();
        $this->activity_id = $this->activity_id ?? $this->activities->first()->id;
    }

    public function render()
    {
        $termino = new \DateTime( 'now' );
        $inicio = (new \DateTime( 'now' ))->sub(new \DateInterval('P7D'));
        
        $periodo = new \DatePeriod($inicio, new \DateInterval('P1D') ,$termino);
       
        $sessionsByDate = $this->sessionsByDate($inicio);
        $data = [];

        foreach($periodo as $p){
            $data[] = $sessionsByDate[$p->format("Y-m-d")] ?? [
                'y' => 0,
                'x' => $p->format("d/m/Y")
            ];
        }
        $this->sessionsByDate = collect($data);
        
        $this->meta = collect(array_fill(0, $this->sessionsByDate->count(), Activity::find($this->activity_id)->timePerDayInHour()));
        
        $this->emit('chartChange', $this->sessionsByDate, $this->meta);

        return view('livewire.reports.report-meta',[
            'activities' => $this->activities,
        ]);
    }

    private function sessionsByDate($inicio)
    {
        $sessions = ActivitySession::orderBy('begin', 'desc')
            ->where('activity_id', $this->activity_id)
            ->where('begin' ,'>', $inicio->format('Y-m-d'))
            ->get();

        $sessionsByDate = $sessions->groupBy(function($item){
                return $item->begin->format('Y-m-d');
            })  
            ->map(function($group){
                return [
                    'y' => $group->sum( function($item){
                        return $item->duration() / 60  ;
                    }),
                    'x' => $group->first()->begin->format('d/m/Y')
                ];
            });
        return $sessionsByDate;
    }
}
