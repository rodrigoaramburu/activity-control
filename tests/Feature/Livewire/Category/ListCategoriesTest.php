<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Support\Facades\Artisan;
use App\Http\Livewire\Categories\ListCategories;

uses(TestCase::class);

beforeEach( function(){
    Artisan::call('migrate:refresh');
});

test('deve listar categorias', function(){

    $categories = Category::factory()->count(5)->create();

    $this->livewire(ListCategories::class)
        ->assertSee($categories[0]->name)
        ->assertSee($categories[1]->name)
        ->assertSee($categories[2]->name);
});