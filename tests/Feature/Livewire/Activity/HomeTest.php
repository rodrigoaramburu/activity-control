<?php 

declare(strict_types=1);

use Tests\TestCase;
use App\Models\Activity;
use App\Http\Livewire\Activities\Home;
use App\Models\Category;
use Illuminate\Support\Facades\Artisan;

uses(TestCase::class);

beforeEach( function(){
    Artisan::call('migrate:refresh');
});

test('deve listar atividades', function(){
    
    $categories = Category::factory()->count(5)->create();
    $activities = Activity::factory()->count(5)->create();

    $this->livewire(Home::class)
        ->assertSee($activities[0]->name)
        ->assertSee($activities[0]->category->name)
        ->assertSee('R$ '. number_format( $activities[0]->valuePerHour/100 , 2, ','))
        ->assertSee($activities[0]->timePerDay)

        ->assertSee($activities[1]->name)
        ->assertSee($activities[2]->name);
});

test('deve filtrar atividades', function(){
    $categories = Category::factory()->count(3)->create();

    $activities1 = Activity::factory()->count(3)->state([
        'category_id' => $categories[0]->id
    ])->create();

    $activities2 = Activity::factory()->count(3)->state([
        'category_id' => $categories[1]->id
    ])->create();

    $this->livewire(Home::class)
        ->set('categoryId', $categories[0]->id)
        ->assertSee($activities1[0]->name)
        ->assertSee($activities1[1]->name)
        ->assertSee($activities1[2]->name)
        ->assertDontSee($activities2[0]->name)
        ->assertDontSee($activities2[1]->name)
        ->assertDontSee($activities2[2]->name);
});

test('deve emitir evento para abrir create', function(){
    $this->livewire(Home::class)
        ->call('openCreate')
        ->assertEmitted('activity.create:show');
});