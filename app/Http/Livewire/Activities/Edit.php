<?php

namespace App\Http\Livewire\Activities;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Category;
use App\Http\Livewire\Activities\Home;

class Edit extends Component
{

    public bool $show = false;

    public string $name = '';
    public int $categoryId = 1;
    public float $valuePerHour = 0;
    public string $timePerDay = '00:00';


    protected $rules = [
        'activity' => 'required',
        'activity.name' => 'required',
        'activity.valuePerHour' => 'integer',
        'activity.timePerDay' => 'time',
    ];

    protected $listeners = [
        'activity.edit:show' => 'show',
        'activity.edit:hidden' => 'hidden',
    ];

    public function mount()
    {
        $this->activity = Activity::make();
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
        $this->name = $activity->name;
        $this->categoryId = $activity->category_id;
        $this->valuePerHour = $activity->valuePerHour / 100;
        $this->timePerDay = $activity->timePerDay;
        $this->show = true;
    }


    public function update()
    {
        $this->validate([
            'name' => 'required|unique:activities',
        ]);

        $this->activity->update([
            'name' => $this->name,
            'category_id' => $this->categoryId,
            'valuePerHour' => $this->valuePerHour * 100,
            'timePerDay' => $this->timePerDay,
        ]);

        $this->emitTo(Home::class, 'activity:updated');
        $this->show = false;
    }

    public function hidden()
    {
        $this->show = false;
    }

}
