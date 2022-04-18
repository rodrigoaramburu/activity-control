<div class="flex justify-between mb-1 gap-2" :key="$category->id . '-category'">
    
    @if(!$this->editing)
    <div class="text-white mb-2 w-full">{{ $category->name}}</div>
    <button wire:click="edit" class="opacity-50 hover:opacity-100 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
        </svg>
    </button>
    @else
    <input type="text" id="category-name" wire:model.defer="category.name" wire:keydown.enter="update" class="w-full" >
    <button wire:click="update" class="opacity-50 hover:opacity-100 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
    </button>
    @endif

    
    <livewire:categories.delete :category="$category" :key="$category->id . '-delete'" />
</div>
