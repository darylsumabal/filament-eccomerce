<?php

namespace App\Filament\Clusters\Product\Resources\Coffees\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class CoffeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->visibility('public')
                    ->required()
                    ->columnSpanFull(),
                Grid::make()->columns(3)->schema([
                    TextInput::make('name')
                        ->label('Name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('price')
                        ->label('Price')
                        ->numeric()
                        ->required(),
                    Select::make('category_id')
                        ->label('Category')
                        ->relationship('category', 'name')
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('Name')
                                ->required()
                                ->maxLength(255),
                        ])
                        ->required(),
                ])->columnSpanFull(),
                Textarea::make('description')
                    ->label('Description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }
}
