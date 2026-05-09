<?php

namespace App\Filament\Admin\Resources\Gestion\Tickets\Pages;

use App\Filament\Admin\Resources\Gestion\Tickets\TicketResource;
use App\Support\AdminDatabaseNotification;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();

        if ($user?->role === 'resident' && $user->resident) {
            $data['building_id'] = $user->resident->copropriete_id;
            $data['apartment_id'] = $user->resident->appartement_id;
            $data['resident_id'] = $user->resident->id;
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $user = Auth::user();

        if ($user && $user->role !== 'admin') {
            AdminDatabaseNotification::send(
                'Nouvelle demande',
                "Une nouvelle demande a été créée : {$this->record->title}"
            );
        }

        $contractorUser = $this->record->contractor?->user;

        if ($contractorUser) {
            $notification = Notification::make()
                ->title('Nouvelle demande assignée')
                ->body("Une nouvelle demande vous a été assignée : {$this->record->title}")
                ->success()
                ->toDatabase();

            $contractorUser->notifyNow($notification);
        }
    }
}
