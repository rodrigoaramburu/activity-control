<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Support\Facades\Artisan;
use App\Http\Livewire\Categories\Create;

uses(TestCase::class);


beforeEach( function(){
    Artisan::call('migrate:refresh');
});

test('deve cadastrar categorias', function(){

    $this->livewire(Create::class)
        ->set('name','Trabalho')
        ->call('save');

    $this->assertDatabaseHas('categories',[
        'name' => 'Trabalho'
    ]);

});

test('não deve cadastrar se name for fazio', function(){
    $this->livewire(Create::class)
        ->set('name','')
        ->call('save')
        ->assertHasErrors(['name' => 'required']);
});

test('não deve cadastrar se name já existir', function(){
    Category::factory()->create([
        'name' => 'Trabalho'
    ]);

    $this->livewire(Create::class)
        ->set('name','Trabalho')
        ->call('save')
        ->assertHasErrors(['name' => 'unique']);
});