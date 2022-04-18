@extends('layouts.app')

@section('title') Categorias @endsection

@section('content')

    <h2 class="text-white text-2xl mb-2 border-b border-white">Categorias</h2>

    <livewire:categories.create />

    <livewire:categories.list-categories />

@endsection