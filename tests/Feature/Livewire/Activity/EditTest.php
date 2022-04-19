<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Support\Facades\Artisan;
use App\Http\Livewire\Activities\Edit;

uses(TestCase::class);


beforeEach( function(){
    Artisan::call('migrate:refresh');
});

test('deve cadastrar atividade', function(){

    $categories = Category::factory()->count(2)->create();
    $activity = Activity::factory()->state([
        'category_id' => $categories[0]->id
    ])->create();

    $this->livewire(Edit::class)
        ->set('activity',$activity)
        ->set('name','Atividade alt')
        ->set('categoryId', $categories[1]->id)
        ->set('valuePerHour','10.33')
        ->set('timePerDay','06:06')

        ->call('update')
        ->assertSet('show', false);

    $this->assertDatabaseHas('activities',[
        'name' => 'Atividade alt',
        'category_id' => $categories[1]->id,
        'valuePerHour' => '1033',
        'timePerDay' => '06:06',
    ]);
});



test('não deve cadastrar se name for fazio', function(){
    $categories = Category::factory()->count(2)->create();
    $activity = Activity::factory()->state([
        'category_id' => $categories[0]->id
    ])->create();

    $this->livewire(Edit::class)
    ->set('activity',$activity)
        ->set('name','')
        ->set('categoryId', 0)
        ->set('valuePerHour', 0.0)
        ->set('timePerDay','00:00')
        ->call('update')
        ->assertHasErrors(['name' => 'required']);
});

test('deve abrir modal se evento show for emitido', function(){

    $categories = Category::factory()->count(2)->create();
    $activity = Activity::factory()->state([
        'category_id' => $categories[0]->id
    ])->create();


    $this->livewire(Edit::class)
        ->emit('activity.edit:show', $activity)
        ->assertSet('show', true);
});