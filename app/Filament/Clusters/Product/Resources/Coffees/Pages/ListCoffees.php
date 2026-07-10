<?php

namespace App\Filament\Clusters\Product\Resources\Coffees\Pages;

use App\Filament\Clusters\Product\Resources\Coffees\CoffeeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCoffees extends ListRecords
{
    protected static string $resource = CoffeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
