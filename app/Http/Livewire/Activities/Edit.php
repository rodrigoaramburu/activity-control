<?php

namespace App\Http\Livewire\Activities;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Category;
use App\Http\Livewire\Activities\Home;

class Edit extends Component
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
        'activity.edit:show' => 'show',
        'activity.edit:hidden' => 'hidden',
    ];

    public function mount()
    {
        $this->activity = new Activity();
    }

    public function render()
    {
        return view('livewire.activities.edit',[
            'categories' => Category::orderBy('name')->get()
        ]);
    }

    public function show(Activity $activity)
    {
        $this->activity = $activity;
         $this->activity->valuePerHour = $activity->valuePerHour / 100;
        $this->show = true;
    }

    public function hidden()
    {
        $this->show = false;
    }


    public function update()
    {
        $this->rules['activity.name'] = 'required|unique:activities,name,'.$this->activity->id;
        $this->validate();
        

        $this->activity->update([
            'name' => $this->activity->name,
            'category_id' => $this->activity->category_id,
            'valuePerHour' => $this->activity->valuePerHour * 100,
            'timePerDay' => $this->activity->timePerDay,
        ]);

        $this->emitTo(Home::class, 'activity:updated');
        $this->show = false;
    }



}
