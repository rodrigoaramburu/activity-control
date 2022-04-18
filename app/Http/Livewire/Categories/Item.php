<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;

class Item extends Component
{

    public Category $category;
    public bool $editing = false;

    protected $rules = [
        'category' => 'required',
        'category.name' => 'required',
    ];

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.categories.item');
    }

    public function edit()
    {
        $this->editing = true;
    }

    public function update()
    {
        $this->category->update();
        $this->editing = false;
        $this->emitTo(ListCategories::class, 'category:updated');
    }
}
