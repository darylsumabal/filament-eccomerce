<?php

use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Models\Category;
use App\Models\User;
use Filament\Actions\Testing\TestAction;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $user = User::factory()->create();

    actingAs($user);

    $this->category = Category::factory()->create();
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

test('an admin can edit a category', function () {

    livewire(ListCategories::class)
        ->callAction(TestAction::make('edit')->table($this->category), [
            'name' => 'Updated Category',
        ])
        ->assertHasNoErrors();

    assertDatabaseHas('categories', [
        'id' => $this->category->id,
        'name' => 'Updated Category',
    ]);
});

test('an admin can soft delete a category', function () {

    $this->category->delete();

    assertSoftDeleted('categories', [
        'id' => $this->category->id,
    ]);

    expect(Category::find($this->category->id))->toBeNull();
    expect(Category::withTrashed()->find($this->category->id))->not->toBeNull();
});

test('an admin can force delete a category', function () {

    $this->category->forceDelete();

    assertDatabaseMissing('categories', [
        'id' => $this->category->id,
    ]);
});
