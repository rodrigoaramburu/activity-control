<div>

    <div class="flex gap-2">
        <button wire:click="openCreate" class="flex gap-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full my-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Nova Sessão
        </button>

        <button wire:click="openCronometer" class="flex gap-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full my-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Iniciar Crônometro
        </button>
    </div>



    @if($this->showCreate)
    <div class="absolute top-0 left-0 bottom-0 right-0 bg-black/50 flex justify-center items-center">
        <div class="h-modal w-1/2 bg-white p-8 pt-2 rounded-3xl">
            <div class="text-right">
                <button wire:click="hiddenCreate" class="rotate-45 text-2xl">+</button>
            </div>
            <form wire:submit.prevent="save" wire:target="save" wire:loading.attr="disable">
                <div class="flex gap-2  xl:flex-row flex-col">
                    <div class="w-full mb-2">
                        <label class="block" for="begin">Início da Sessão:</label>
                        <input class="w-full" type="datetime-local" id="begin" wire:model.defer="activitySession.begin" placeholder="Início da Sessão">
                        @error('activitySession.begin')
                        <div class="text-red-500 p-2 bg-red-100 mt-2">{{$message}}</div>
                        @enderror
                    </div>
                    
                    <div class="w-full mb-2">
                        <label class="block" for="end">Final da Sessão:</label>
                        <input class="w-full" type="datetime-local" id="end" wire:model.defer="activitySession.end" placeholder="Final da Sessão">
                        @error('activitySession.end')
                        <div class="text-red-500 p-2 bg-red-100 mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <labe class="block" for="activity_id">Atividade:</label>
                    <select class="w-full block" id="activity_id" wire:model.defer="activitySession.activity_id">
                        <option value="0">Selecione</option>
                        @foreach($activities as $activity)
                            <option value="{{$activity->id}}">{{$activity->name}}</option>
                        @endforeach
                    </select>
                    @error('activitySession.activity_id')
                    <div class="text-red-500 p-2 bg-red-100 mt-2">{{$message}}</div>
                    @enderror
                </div>

                <div class="full mb-2">
                    <label class="block" for="description">Descrição:</label>
                    <textarea class="w-full" type="text" id="description" wire:model.defer="activitySession.description" placeholder="Descrição"></textarea>
                    @error('activitySession.description')
                    <div class="text-red-500 p-2 bg-red-100 mt-2">{{$message}}</div>
                    @enderror
                </div>
                
            

                <button class="flex gap-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full my-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span wire:loading.remove>Adicionar</span>
                    <span wire:loading>Adicionando ...</span>
                </button>
            </form>
        </div>
        

    </div>
    @endif

    @if($this->showCronometer)

    <script>
        window.cronometer = function(){
        
        return {
            begin: null,
            end: null,
            beginInput: @entangle('activitySession.begin'),
            endInput:  @entangle('activitySession.end'),
            currentTime: 0,
            timer: null,

            start: function(){
                this.begin = new Date();
                this.beginInput = this.formatDate(this.begin);

                let _this = this;
                this.timer = setInterval( function(){
                    _this.currentTime = new Date() - _this.begin;
                },500);
            },

            stop: function(){
                this.end = new Date();
                this.currentTime = this.end - this.begin;
                this.endInput = this.formatDate(this.end);
                clearInterval(this.timer);
            },

            formatDate: function (date) {
                if(date == null) return '';
                return [
                    date.getFullYear(),
                    (date.getMonth() + 1).toString().padStart(2, '0'),
                    date.getDate().toString().padStart(2, '0'),
                ].join('-') 
                + 'T' +[
                    date.getHours().toString().padStart(2, '0'),
                    date.getMinutes().toString().padStart(2, '0'),
                ].join(':');
            },

            formatTime: function(miliseconds){
                return [        
                    Math.floor(miliseconds / 3600000 ).toString().padStart(2, '0'),
                    Math.floor((miliseconds / 60000) % 60).toString().padStart(2, '0'),
                    Math.floor((miliseconds / 1000) % 60).toString().padStart(2, '0'),
                ].join(':');
            }

        }
    }
    </script>


    <div class="absolute top-0 left-0 bottom-0 right-0 bg-black/50 flex justify-center items-center">
        <div class="h-modal w-1/2 bg-white p-8 pt-2 rounded-3xl">
            <div class="text-right">
                <button wire:click="hiddenCronometer" class="rotate-45 text-2xl">+</button>
            </div>
        

        
        <div x-data="cronometer()">
            <h4 class="text-3xl text-center" x-text="formatTime(currentTime)"></h4>
            

            <div class="flex justify-center">
                <button x-show="begin == null" @click="start()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full my-2">Iniciar</button>
                <button x-show="begin != null && end == null" @click="stop()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full my-2">Parar</button>
            </div>

            <form wire:submit.prevent="save" wire:target="save" wire.loading.attr="disable">
                <div class="flex gap-2 xl:flex-row flex-col">
                    <div  class="w-full mb-2">
                        <div class="block text-xl">Início: {{$activitySession->begin?->format('d/m/Y H:i:s')}}</div>
                        <input class="w-full block" name="begin" type="hidden" wire:model.defer="activitySession.begin" x-model="beginInput" readonly>
                        @error('activitySession.begin')
                            <div class="text-red-500 p-2 bg-red-100 mt-2">{{$message}}</div>
                        @enderror
                    </div>
                    
                    <div  class="w-full mb-2">
                    <div class="block text-xl">Final: {{$activitySession->end?->format('d/m/Y H:i:s')}}</div>
                        <input class="w-full block" type="hidden" wire:model.defer="activitySession.end" x-model="endInput" readonly>
                        @error('activitySession.begin')
                            <div class="text-red-500 p-2 bg-red-100 mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <labe class="block" for="activity_id">Atividade:</label>
                    <select class="w-full block" id="activity_id" wire:model.defer="activitySession.activity_id">
                        <option value="0">Selecione</option>
                        @foreach($activities as $activity)
                            <option value="{{$activity->id}}">{{$activity->name}}</option>
                        @endforeach
                    </select>
                    @error('activitySession.activity_id')
                    <div class="text-red-500 p-2 bg-red-100 mt-2">{{$message}}</div>
                    @enderror
                </div>

                <div class="full mb-2">
                    <label class="block" for="description">Descrição:</label>
                    <textarea class="w-full" type="text" id="description" wire:model.defer="activitySession.description" placeholder="Descrição"></textarea>
                    @error('activitySession.description')
                    <div class="text-red-500 p-2 bg-red-100 mt-2">{{$message}}</div>
                    @enderror
                </div>

                <button x-show="begin && end" class="flex gap-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full my-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span wire:loading.remove target="save">Adicionar</span>
                    <span wire:loading  target="save">Adicionando ...</span>
                </button>
            </form>
        </div>
    </div>


    @endif

</div>