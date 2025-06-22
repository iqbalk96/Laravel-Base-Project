<?php

namespace App\Filament\Resources\VisionMissionResource\Pages;

use App\Filament\Resources\VisionMissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVisionMissions extends ListRecords
{
    protected static string $resource = VisionMissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
