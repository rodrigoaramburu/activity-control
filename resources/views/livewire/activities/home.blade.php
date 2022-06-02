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
    
    <button wire:click="openCreate" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full my-2">Adicionar</button>

    <livewire:activities.create />
    <livewire:activities.edit />

    <table class="text-white w-full">
        <tr class="bg-gray-100/50">
            <th>Atividade</th>
            <th>Categoria</th>
            <th>Valor Por Hora</th>
            <th>Meta diária</th>
            <th></th>
        </tr>
    @foreach($activities as $activity)
        <livewire:activities.item :activity="$activity" :key="$activity->id . time()" />
    @endforeach
    </table>

</div>