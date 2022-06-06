<div class="">
    @if($this->show)
    <div class="absolute top-0 left-0 bottom-0 right-0 bg-black/50 flex justify-center items-center">
        <div class="h-modal w-1/2 bg-white p-8 pt-2 rounded-3xl">
            <div class="text-right">
                <button wire:click="hidden" class="rotate-45 text-2xl">+</button>
            </div>
            
            <form wire:submit.prevent="update" wire:target="update" wire:loading.attr="disable">
                <div class="w-full mb-2">
                    <label class="block" for="name">Nome:</label>
                    <input class="w-full" type="text" id="name" wire:model.defer="activity.name" placeholder="Nome da Atividade">
                    @error('activity.name')
                    <div class="text-red-500 p-2 bg-red-100 mt-2">{{$message}}</div>
                    @enderror
                </div>
                
                <div class="w-full mb-2">
                    <label for="category">Cateogria: </label>
                    <select class="w-full block" id="category" wire:model.defer="activity.category_id">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('activity.category_id')
                    <div class="text-red-500 p-2 bg-red-100 mt-2">{{$message}}</div>
                    @enderror
                </div>
                    
                <div class="w-full mb-2">
                    <label class="w-full block" for="name">Valor Por Hora:</label>
                    <input class="w-full" type="number" id="valuePerHour" step="0.01" wire:model.defer="activity.valuePerHour" placeholder="Valor por Hora">
                    @error('activity.valuePerHour')
                    <div class="text-red-500 p-2 bg-red-100 mt-2">{{$message}}</div>
                    @enderror
                </div>
                
                <div class="w-full mb-2">
                    <label class="w-full block" for="name">Horas Diárias:</label>
                    <input class="w-full" type="time" id="timePerDay" wire:model.defer="activity.timePerDay" placeholder="Horas Diárias">
                    @error('activity.timePerDay')
                    <div class="text-red-500 p-2 bg-red-100 mt-2">{{$message}}</div>
                    @enderror
                </div>    

                <button class="flex gap-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full my-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span wire:loading.remove wire:target="update">Alterar</span>
                    <span wire:loading wire:target="update">Alterando ...</span>
                </button>
            </form>
        </div>
        
          

        </div>
        </div>
    </div>
    @endif
</div>
