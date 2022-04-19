<?php

namespace App\Http\Livewire\Activities;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Category;
use App\Http\Livewire\Activities\Create;

class Home extends Component
{

    public int $categoryId = 0;


    protected $listeners = [
        'activity:created' => '$refresh',
        'activity:deleted' => '$refresh',
        'activity:updated' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.activities.home',[
            'categories' => Category::orderBy('name')->get(),
            'activities' => Activity::orderBy('name')
                ->when($this->categoryId !== 0, fn($q) => $q->where('category_id', $this->categoryId))
                ->get(),
        ]);
    }

    public function openCreate()
    {
        $this->emitTo(Create::class,'activity.create:show');
    }
}
