<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Support\Facades\Artisan;
use App\Http\Livewire\Categories\Create;
use App\Http\Livewire\Categories\Delete;

uses(TestCase::class);

beforeEach( function(){
    Artisan::call('migrate:refresh');
});

test('deve deletar categoria', function(){
    $category = Category::factory()->create([
        'name' => 'Trabalho'
    ]);

    $this->livewire(Delete::class)
        ->set('category', $category)
        ->call('destroy');

    $this->assertDatabaseMissing('categories',[
        'name' => $category->name
    ]);
});