<div>

    <div class="flex justify-end items-center w-full">
        <label for="filer" class="text-white mr-4">Filter by:</label>
        <select wire:model="activity_id_filter">
            <option value="">Todos</option>
            @foreach ($activities as $activity)
                <option value="{{ $activity->id }}">{{ $activity->name }}</option>
            @endforeach
        </select>
    </div>
    
    <table  class="text-white w-full mt-4">
        <tr  class="bg-gray-100/50">
            <th>Atividade</th>
            <th>Duração</th>
            <th>Início</th>
            <th>Final</th>
            <th>Descrição</th>
            <th></th>
        </tr>
        @foreach($sessions as $session)
         <livewire:session-activity.item :session="$session"  :key="$session->id . time()" />
        @endforeach
    </table>
</div>
