<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;

class Home extends Component
{
    public string $report = 'hours';

    public function render()
    {
        return view('livewire.reports.home');
    }
}
