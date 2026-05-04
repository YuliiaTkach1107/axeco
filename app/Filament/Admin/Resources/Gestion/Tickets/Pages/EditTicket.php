<?php

namespace App\Filament\Admin\Resources\Gestion\Tickets\Pages;

use App\Filament\Admin\Resources\Gestion\Tickets\TicketResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditTicket extends EditRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->visible(fn () => Auth::user()->role === 'admin'),
        ];
    }

    protected function afterSave(): void
    {
        if (! $this->record->wasChanged('contractor_id')) {
            return;
        }

        $contractorUser = $this->record->contractor?->user;

        if (! $contractorUser) {
            return;
        }

        $notification = Notification::make()
            ->title('Nouvelle demande assignee')
            ->body("Une demande vous a ete assignee : {$this->record->title}")
            ->success()
            ->toDatabase();

        $contractorUser->notifyNow($notification);
    }
}
