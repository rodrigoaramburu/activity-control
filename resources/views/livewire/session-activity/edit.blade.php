<div class="">
    @if($this->show)
    <div class="absolute top-0 left-0 bottom-0 right-0 bg-black/50 flex justify-center items-center">
        <div class="h-modal w-1/2 bg-white p-8 pt-2 rounded-3xl">
            <div class="text-right">
                <button wire:click="hidden" class="rotate-45 text-2xl">+</button>
            </div>
                
            <form wire:submit="update" wire:target="update" wire:loading.attr="disable">
                <div class="flex gap-2 xl:flex-row flex-col">
                    <div class="w-full mb-2">
                        <label class="block" for="begin">Início da Sessão:</label>
                        <input class="w-full" type="datetime-local" id="begin" wire:model.defer="begin" placeholder="Início da Sessão">
                        @error('activitySession.begin')
                        <div class="text-red-500 text-xl p-2 bg-red-100 mt-2">{{$message}}</div>
                        @enderror
                    </div>
                    
                    <div class="w-full mb-2">
                        <label class="block" for="end">Final da Sessão:</label>
                        <input class="w-full" type="datetime-local" id="end" wire:model.defer="end" placeholder="Final da Sessão">
                        @error('activitySession.end')
                        <div class="text-red-500 text-xl p-2 bg-red-100 mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                
                
                <div>
                    <labe class="block" for="activity_id">Atividade:</label>
                    <select class="w-full block" id="activity_id" wire:model.defer="activitySession.activity_id">
                        @foreach($activities as $activity)
                            <option value="{{$activity->id}}">{{$activity->name}}</option>
                        @endforeach
                    </select>
                    @error('activitySession.end')
                    <div class="text-red-500 text-xl p-2 bg-red-100 mt-2">{{$message}}</div>
                    @enderror
                </div>
                
                <div class="full mb-2">
                    <label class="block" for="description">Descrição:</label>
                    <textarea class="w-full" type="text" id="description" wire:model.defer="activitySession.description" placeholder="Descrição"></textarea>
                    @error('activitySession.description')
                    <div class="text-red-500 text-xl p-2 bg-red-100 mt-2">{{$message}}</div>
                    @enderror
                </div>

                <button class="flex gap-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full my-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span wire:target="update" wire:loading.remove>Alterar</span>
                    <span wire:target="update" wire:loading>Alterando ...</span>
                </button>
            </form>
        </div>
        
          

        </div>
        </div>
    </div>
    @endif
</div>
