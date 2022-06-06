<?php

namespace App\Http\Livewire\Activities;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Support\Collection;
use App\Http\Livewire\Activities\Home;

class Create extends Component
{

    public bool $show = false;

    public Activity $activity;

    protected $rules = [
        'activity.name' => 'required|unique:activities,name',
        'activity.category_id' => 'required|exists:categories,id',
        'activity.valuePerHour' => 'numeric|min:0',
        'activity.timePerDay' => 'string',
    ];

    protected $messages = [
        'activity.name.required' => 'O nome da atividade deve ser preenchido',
        'activity.name.unique' => 'Já existe uma atividade com esse nome',
        'activity.category_id.required' => 'A categoria deve ser preenchido',
        'activity.category_id.exists' => 'Categoria inválida',
    ];

    protected $listeners = [
        'activity.create:show' => 'show',
        'activity.create:hidden' => 'hidden',
    ];

    
    public function mount()
    {
        $this->activity = new Activity([
            'category_id' =>  0,
            'valuePerHour' => 0,
            'timePerDay' => '00:00',
        ]);
    }
    
    public function render()
    {
        return view('livewire.activities.create',[
            'categories' => Category::orderBy('name')->get()
        ]);
    }
    
    
    public function save()
    {       
        $this->validate();

        Activity::create([
            'name' => $this->activity->name,
            'category_id' => $this->activity->category_id,
            'valuePerHour' => $this->activity->valuePerHour * 100,
            'timePerDay' => $this->activity->timePerDay
        ]);

        $this->emitTo(Home::class, 'activity:created');
        $this->show = false;

        $this->activity = new Activity([
            'category_id' =>  0,
            'valuePerHour' => 0,
            'timePerDay' => '00:00',
        ]);
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
