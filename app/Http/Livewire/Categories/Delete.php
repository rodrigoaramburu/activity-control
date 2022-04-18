<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;

class Delete extends Component
{

    public Category $category;

    protected $rules = [
        'category' => 'required',
    ];

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.categories.delete');
    }

    public function destroy(): void
    {
        $this->category->delete();
        $this->emitTo(ListCategories::class, 'category:deleted');
    }
}
