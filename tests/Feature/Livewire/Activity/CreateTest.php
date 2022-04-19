<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Support\Facades\Artisan;
use App\Http\Livewire\Activities\Create;

uses(TestCase::class);


beforeEach( function(){
    Artisan::call('migrate:refresh');
});

test('deve cadastrar atividade', function(){

    $category = Category::factory()->create();

    $this->livewire(Create::class)
        ->set('name','Atividade')
        ->set('categoryId', $category->id)
        ->set('valuePerHour','1.50')
        ->set('timePerDay','02:00')
        ->call('save')
        ->assertSet('show', false);

    $this->assertDatabaseHas('activities',[
        'name' => 'Atividade',
        'category_id' => $category->id,
        'valuePerHour' => '150',
        'timePerDay' => '02:00',
    ]);
});



test('não deve cadastrar se name for fazio', function(){
    $this->livewire(Create::class)
        ->set('name','')
        ->set('categoryId', 0)
        ->set('valuePerHour', 0.0)
        ->set('timePerDay','00:00')
        ->call('save')
        ->assertHasErrors(['name' => 'required']);
});


test('não deve cadastrar se name já existir', function(){
    $category = Category::factory()->create();

    $activity = Activity::factory()->count(3)->state([
        'name' => 'Atividade',
        'category_id' => $category->id
    ])->create();



    $this->livewire(Create::class)
        ->set('name','Atividade')
        ->call('save')
        ->assertHasErrors(['name' => 'unique']);
});


test('deve abrir modal se evento show for emitido', function(){

    $this->livewire(Create::class)
        ->emit('activity.create:show')
        ->assertSet('show', true);
});