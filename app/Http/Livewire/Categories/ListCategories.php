<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;

class ListCategories extends Component
{

    protected  $listeners = [
        'category:created' => '$refresh',
        'category:deleted' => '$refresh',
        'category:updated' => '$refresh',
    ];
    public function render()
    {
        return view('livewire.categories.list-categories',[
            'categories' => Category::orderBy('name')->get()
        ]);
    }
}
