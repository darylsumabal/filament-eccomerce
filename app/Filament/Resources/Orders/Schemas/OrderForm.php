<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('customer_name')
                    ->label('Customer Name')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('receipt')
                    ->label('Receipt')
                    ->image()
                    ->disk('public')
                    ->directory('receipts')
                    ->visibility('public')
                    ->required(),
            ]);
    }
}
