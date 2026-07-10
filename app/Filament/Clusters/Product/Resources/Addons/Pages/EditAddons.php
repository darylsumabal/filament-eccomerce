<?php

namespace App\Filament\Clusters\Product\Resources\Addons\Pages;

use App\Filament\Clusters\Product\Resources\Addons\AddonsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditAddons extends EditRecord
{
    protected static string $resource = AddonsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
