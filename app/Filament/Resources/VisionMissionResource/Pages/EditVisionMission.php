<?php

namespace App\Filament\Resources\VisionMissionResource\Pages;

use App\Filament\Resources\VisionMissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisionMission extends EditRecord
{
    protected static string $resource = VisionMissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // 
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
