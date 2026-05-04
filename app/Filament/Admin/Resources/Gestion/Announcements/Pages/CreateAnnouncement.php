<?php

namespace App\Filament\Admin\Resources\Gestion\Announcements\Pages;

use App\Filament\Admin\Resources\Gestion\Announcements\AnnouncementResource;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Builder;

class CreateAnnouncement extends CreateRecord
{
    protected static string $resource = AnnouncementResource::class;

    protected function afterCreate(): void
    {
        $buildingId = $this->record->building_id;

        if (! $buildingId) {
            return;
        }

        $notification = Notification::make()
            ->title('Nouvelle annonce')
            ->body("Une nouvelle annonce a ete publiee : {$this->record->titre}")
            ->success()
            ->toDatabase();

        User::query()
            ->where(function (Builder $query) use ($buildingId): void {
                $query
                    ->where(function (Builder $residentQuery) use ($buildingId): void {
                        $residentQuery
                            ->where('role', 'resident')
                            ->whereHas('resident', fn (Builder $residentRelationQuery): Builder => $residentRelationQuery->where('copropriete_id', $buildingId));
                    })
                    ->orWhere(function (Builder $ownerQuery) use ($buildingId): void {
                        $ownerQuery
                            ->where('role', 'proprietaire')
                            ->whereHas('apartments', fn (Builder $apartmentQuery): Builder => $apartmentQuery->where('copropriete_id', $buildingId));
                    });
            })
            ->each(fn (User $user) => $user->notifyNow($notification));
    }
}
