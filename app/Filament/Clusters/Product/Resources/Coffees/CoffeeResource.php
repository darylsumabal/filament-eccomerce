<?php

namespace App\Filament\Clusters\Product\Resources\Coffees;

use App\Filament\Clusters\Product\ProductCluster;
use App\Filament\Clusters\Product\Resources\Coffees\Pages\ListCoffees;
use App\Filament\Clusters\Product\Resources\Coffees\Schemas\CoffeeForm;
use App\Filament\Clusters\Product\Resources\Coffees\Tables\CoffeesTable;
use App\Models\Product;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CoffeeResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Truck;

    protected static ?string $cluster = ProductCluster::class;

    public static function form(Schema $schema): Schema
    {
        return CoffeeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CoffeesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCoffees::route('/'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
