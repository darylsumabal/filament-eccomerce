<?php

namespace App\Filament\Clusters\Product\Resources\Coffees\Pages;

use App\Filament\Clusters\Product\Resources\Coffees\CoffeeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCoffee extends CreateRecord
{
    protected static string $resource = CoffeeResource::class;
}
