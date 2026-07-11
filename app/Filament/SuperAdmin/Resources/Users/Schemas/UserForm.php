<?php

namespace App\Filament\SuperAdmin\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')->password()->dehydrated(fn(?string $state): bool => filled($state))->required(fn(string $operation): bool => $operation === 'create'),
                Select::make('roles')->relationship('roles', 'name', modifyQueryUsing: fn($query) => $query->where('name', '!=', 'super_admin'))->preload()->searchable()->required(),
                Select::make('team')->relationship('teams', 'name')->required(),
            ]);
    }
}
