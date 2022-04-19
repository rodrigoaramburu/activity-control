<div class="">
    @if($this->show)
    <div class="absolute top-0 left-0 bottom-0 right-0 bg-black/50 flex justify-center items-center">
        <div class="h-modal w-1/2 bg-white p-8 pt-2 rounded-3xl">
            <div class="text-right">
                <button wire:click="hidden" class="rotate-45 text-2xl">+</button>
            </div>
                
            <div class="w-full mb-2">
                <label class="block" for="name">Nome:</label>
                <input class="w-full" type="text" id="name" wire:model.defer="name" placeholder="Nome da Atividade">
                @error('name')
                <div class="text-red-500 text-xl p-2 bg-red-100 mt-2">{{$message}}</div>
                @enderror
            </div>
            
            <div class="w-full mb-2">
                <label for="category">Cateogria: </label>
                <select class="w-full block" id="category" wire:model.defer="categoryId">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('categoryId')
                <div class="text-red-500 text-xl p-2 bg-red-100 mt-2">{{$message}}</div>
                @enderror
            </div>
                
            <div class="w-full mb-2">
                <label class="w-full block" for="name">Valor Por Hora:</label>
                <input class="w-full" type="number" id="valuePerHour" step="0.01" wire:model.defer="valuePerHour" placeholder="Valor por Hora">
            </div>
            
            <div class="w-full mb-2">
                <label class="w-full block" for="name">Horas Diárias:</label>
                <input class="w-full" type="time" id="timePerDay" wire:model.defer="timePerDay" placeholder="Horas Diárias">
            </div>    

            <button wire:click="update" class="bg-white px-4 py-2 rounded flex justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Alterar
            </button>
        </div>
        
          

        </div>
        </div>
    </div>
    @endif
</div>
