<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use App\Http\Livewire\Categories\Item;
use Illuminate\Support\Facades\Artisan;

uses(TestCase::class);

beforeEach( function(){
    Artisan::call('migrate:refresh');
});

test('deve exibir nome da categoria', function(){
    $category = Category::factory()->create([
        'name' => 'Trabalho'
    ]);

    $this->livewire(Item::class)
        ->set('category', $category)
        ->assertSee('Trabalho');   
});

test('deve habilitar edição do categoria', function(){
    $category = Category::factory()->create([
        'name' => 'Trabalho'
    ]);

    $this->livewire(Item::class)
        ->set('category', $category)
        ->call('edit')
        ->assertSet('editing', true)
        ->assertSee('<input type="text" id="category-name"', false);
});


test('deve atualizar categoria', function(){
    $category = Category::factory()->create([
        'name' => 'Trabalho'
    ]);

    $this->livewire(Item::class)
        ->set('category', $category)
        ->set('category.name', 'Trabalho alt')
        ->call('update')
        ->assertSet('editing', false);

    $this->assertDatabaseHas('categories',[
        'name' => 'Trabalho alt'
    ]);
});