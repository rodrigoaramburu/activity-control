@extends('layouts.app')

@section('title') Sessões de Atividades @endsection

@section('content')

    <h2 class="text-white text-2xl mb-4 border-b border-white">Sessões de Atividades</h2>


    <livewire:session-activity.create />
    <livewire:session-activity.edit />
    
    <livewire:session-activity.list-sessions />

@endsection