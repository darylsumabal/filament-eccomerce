<?php

namespace App\Filament\Clusters\Product\Resources\Addons;

use App\Filament\Clusters\Product\ProductCluster;
use App\Filament\Clusters\Product\Resources\Addons\Pages\ListAddons;
use App\Filament\Clusters\Product\Resources\Addons\Schemas\AddonsForm;
use App\Filament\Clusters\Product\Resources\Addons\Tables\AddonsTable;
use App\Models\Addons;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddonsResource extends Resource
{
    protected static ?string $model = Addons::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = ProductCluster::class;

    protected static ?string $recordTitleAttribute = 'Addon';

    public static function form(Schema $schema): Schema
    {
        return AddonsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AddonsTable::configure($table);
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
            'index' => ListAddons::route('/'),
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
