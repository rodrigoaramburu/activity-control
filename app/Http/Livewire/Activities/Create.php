<?php

namespace App\Http\Livewire\Activities;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Category;
use App\Http\Livewire\Activities\Home;

class Create extends Component
{

    public bool $show = false;

    public string $name = '';
    public int $categoryId = 1;
    public float $valuePerHour = 0;
    public string $timePerDay = '00:00';

    protected $rules = [
        'activity.name' => 'required',
        'activity.valuePerHour' => 'integer',
        'activity.timePerDay' => 'time',
    ];

    protected $listeners = [
        'activity.create:show' => 'show',
        'activity.create:hidden' => 'hidden',
    ];

    
    public function mount()
    {
        $this->activity = Activity::make();
    }
    
    public function render()
    {
        return view('livewire.activities.create',[
            'categories' => Category::orderBy('name')->get()
        ]);
    }
    
    
    public function save()
    {       
        $this->validate([
            'name' => 'required|unique:activities',
        ],
        [
            'name.required' => 'O nome da atividade deve ser preenchido',
            'name.unique' => 'Já existe uma atividade com esse nome'
        ]);
        
        Activity::create([
            'name' => $this->name,
            'category_id' => $this->categoryId,
            'valuePerHour' => $this->valuePerHour * 100,
            'timePerDay' => $this->timePerDay
        ]);
        
        $this->reset('name','categoryId','valuePerHour','timePerDay');
        $this->emitTo(Home::class, 'activity:created');
        $this->show = false;
    }

    public function show()
    {
        $this->show = true;
    }

    public function hidden()
    {
        $this->show = false;
    }
    
}
