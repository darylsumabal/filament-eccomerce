<?php

use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;


beforeEach(function () {
    $user = User::factory()->create();

    actingAs($user);
});

test('an admin can create a category', function () {

    livewire(ListCategories::class)
        ->callAction('create', data: [
            'name' => 'Test Category',
        ])->assertHasNoErrors();

    assertDatabaseHas('categories', [
        'name' => 'Test Category',
    ]);
});
