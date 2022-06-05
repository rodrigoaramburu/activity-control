<div>

    <div class="flex gap-2 justify-center p-4">
        <a href="{{route('reports',['report'=>'hours'])}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full my-2">Atividades por Hora</a>
        <a href="{{route('reports',['report'=>'value'])}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full my-2">Atividades por Valor</a>
        <a href="{{route('reports',['report'=>'meta'])}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full my-2">Meta</a>
    </div>
    
    @if(request()->input('report') == 'hours')
    <livewire:reports.report-hours />
    @endif
    
    @if(request()->input('report') == 'value')
        <livewire:reports.report-value />
    @endif

    @if(request()->input('report') == 'meta')
        <livewire:reports.report-meta />
    @endif

</div>
