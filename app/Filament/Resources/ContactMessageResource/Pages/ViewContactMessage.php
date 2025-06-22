<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;
use Filament\Notifications\Notification;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Tandai sebagai dibaca')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn() => !$this->record->is_read)
                ->action(function () {
                    if (! $this->record->is_read) {
                        $this->record->update(['is_read' => true]);

                        Notification::make()
                            ->title('Pesan dibaca')
                            ->body('Pesan berhasil ditandai sebagai dibaca.')
                            ->success()
                            ->send();
                    }
                }),
        ];
    }
}
