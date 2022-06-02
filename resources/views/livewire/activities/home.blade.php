<div>

    <div class="text-white text-2xl flex justify-center gap-4 py-4">
        <label for="all">
            <input type="radio" id="all" name="categoryId" wire:model="categoryId" value="0">
            <span>All</span>
        </label>

        @foreach($categories as $category)
        <label for="category-{{$category->id}}">
            <input type="radio" id="category-{{$category->id}}" name="categoryId" wire:model="categoryId" value={{$category->id}}>
            <span>{{$category->name}}</span>
        </label>
        @endforeach
        
    </div>
    
    <button wire:click="openCreate" class="flex gap-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full my-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Nova atividade
    </button>

    <livewire:activities.create />
    <livewire:activities.edit />

    <table class="text-white w-full">
        <tr class="bg-white text-black">
            <th class="p-1">Atividade</th>
            <th class="p-1">Categoria</th>
            <th class="p-1">Valor Por Hora</th>
            <th class="p-1">Meta diária</th>
            <th></th>
        </tr>
    @foreach($activities as $activity)
        <livewire:activities.item :activity="$activity" :key="$activity->id . time()" />
    @endforeach
    </table>

</div>