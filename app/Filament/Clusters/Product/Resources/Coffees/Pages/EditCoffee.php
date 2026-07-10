<?php

namespace App\Filament\Clusters\Product\Resources\Coffees\Pages;

use App\Filament\Clusters\Product\Resources\Coffees\CoffeeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditCoffee extends EditRecord
{
    protected static string $resource = CoffeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
