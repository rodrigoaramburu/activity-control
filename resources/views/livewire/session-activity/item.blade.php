<tr class="odd:bg-gray-100/10">
    <td>{{$session->activity->name}}</td>
    <td>{{$session->duration()}} min.</td>
    <td>{{$session->begin?->format('d/m/Y H:i')}}</td>
    <td>{{$session->end?->format('d/m/Y H:i')}}</td>
    <td>{{$session->description}}</td>
    <td class="p-1 flex gap-2">
        <button wire:click="edit">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
        </button>
        <livewire:session-activity.delete :session="$session" :key="$session->id . '-delete'" />
    </td>
</tr>