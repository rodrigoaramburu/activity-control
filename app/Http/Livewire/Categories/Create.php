<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;
use App\Http\Livewire\Categories\ListCategories;

class Create extends Component
{

    public string $name = "";

    public function render()
    {
        return view('livewire.categories.create');
    }

    public function save(): void
    {

        $this->validate([
            'name' => 'required|unique:categories'
        ]);

        Category::create([
            'name' => $this->name
        ]);

        $this->reset('name');
        $this->emitTo(ListCategories::class,'category:created');
    }
}
