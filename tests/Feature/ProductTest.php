<?php

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Livewire\livewire;


beforeEach(function () {
    $user = User::factory()->create();
    $this->product = Product::factory()->create();
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


test('an admin can edit the product', function () {
    $image = UploadedFile::fake()->image('product-image.jpg');
    livewire(EditProduct::class, [
        'record' => $this->product->getKey(), // Passes the ID of your test product
    ])->fillForm([
        'image' => $image,
        'name' => 'Updated Product',
        'description' => 'Updated Description',
        'price' => 19.99,
    ])->call('save')
        ->assertHasNoFormErrors()
        ->assertNotified();
        
    assertDatabaseHas(Product::class, [
        'id' => $this->product->id,
        'name' => 'Updated Product',
        'description' => 'Updated Description',
        'price' => 19.99,
    ]);
});

test('an admin can soft delete the product', function () {

    $this->product->delete();

    assertSoftDeleted($this->product);

    expect(Product::find($this->product->id))->toBeNull();

    expect(Product::withTrashed()->find($this->product->id))->not->toBeNull();
});

test('an admin can force delete the product', function () {

    $this->product->forceDelete();

    assertDatabaseMissing(Product::class, [
        'id' => $this->product->id,
    ]);
});
