<?php

namespace App\Filament\Clusters\Product\Resources\Addons\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class AddonsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()->columns(2)->schema([
                    TextInput::make('name')
                        ->label('Name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('price')
                        ->label('Price')
                        ->numeric()
                        ->required()
                        ->prefix('₱'),
                ])->columnSpanFull(),
            ]);
    }
}
