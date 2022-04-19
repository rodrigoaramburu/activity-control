<div>
    <div class="flex gap-2">
        
        <input class="w-full" type="text" placeholder="Nome da Categoria" wire:model.defer="name">
        
        <button class="bg-white p-3 rounded" wire:click="save">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
        </button>
    </div>
    @error('name')
        <div class="text-red-500 text-xl p-2 bg-red-100 mt-2">{{$message}}</div>
    @enderror
</div>