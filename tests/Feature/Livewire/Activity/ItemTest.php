<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Activity;
use App\Models\Category;
use App\Http\Livewire\Activities\Item;
use Illuminate\Support\Facades\Artisan;

uses(TestCase::class);

beforeEach( function(){
    Artisan::call('migrate:refresh');
});

test('deve exibir nome da atividade', function(){
    $categories = Category::factory()->count(2)->create();
    $activity = Activity::factory()->state([
        'category_id' => $categories[0]->id
    ])->create();

    $this->livewire(Item::class, ['activity' => $activity])
        ->assertSee($activity->name)
        ->assertSee($activity->category->name)
        ->assertSee( 'R$ '.number_format($activity->valuePerHour/100,2,','))
        ->assertSee($activity->timePerDay);   
});



test('deve emitir evento para abrir edicao', function(){
    $categories = Category::factory()->count(2)->create();
    $activity = Activity::factory()->state([
        'category_id' => $categories[0]->id
    ])->create();

    $this->livewire(Item::class, ['activity' => $activity])
        ->call('edit')
        ->assertEmitted('activity.edit:show');
});