<?php

namespace App\Filament\Resources\PrivacyPolicyResource\Pages;

use App\Filament\Resources\PrivacyPolicyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrivacyPolicy extends EditRecord
{
    protected static string $resource = PrivacyPolicyResource::class;

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
