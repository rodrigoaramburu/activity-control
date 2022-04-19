<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Support\Facades\Artisan;
use App\Http\Livewire\Activities\Delete;
use App\Models\Activity;

uses(TestCase::class);

beforeEach( function(){
    Artisan::call('migrate:refresh');
});

test('deve deletar atividade', function(){
    Category::factory()->create();

    $activity = Activity::factory()->create([
        'name' => 'Atividade'
    ]);

    $this->livewire(Delete::class)
        ->set('activity', $activity)
        ->call('destroy');

    $this->assertDatabaseMissing('activities',[
        'name' => $activity->name
    ]);
});