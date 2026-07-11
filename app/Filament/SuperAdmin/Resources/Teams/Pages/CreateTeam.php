<?php

namespace App\Filament\SuperAdmin\Resources\Teams\Pages;

use App\Filament\SuperAdmin\Resources\Teams\TeamResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTeam extends CreateRecord
{
    protected static string $resource = TeamResource::class;
}
