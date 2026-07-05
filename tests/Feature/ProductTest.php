<?php

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;


beforeEach(function () {
    $user = User::factory()->create();

    actingAs($user);
    Storage::fake('public');
});

test('an admin can create a product', function () {

    $category = Category::factory()->create();
    $image = UploadedFile::fake()->image('product.jpg');
    livewire(CreateProduct::class)
        ->fillForm([
            'image' => $image,
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 9.99,
            'category_id' => $category->id,
        ])
        ->call('create')
        ->assertHasNoFormErrors()
        ->assertNotified()
        ->assertRedirect();

    assertDatabaseHas(Product::class, [
        'name' => 'Test Product',
        'description' => 'Test Description',
        'price' => 9.99,
        'category_id' => $category->id,
    ]);

    $product = Product::where('name', 'Test Product')->first();

    Storage::disk('public')->assertExists($product->image);
});
