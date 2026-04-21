<?php

namespace App\Filament\Admin\Resources\Gestion\Tickets\Pages;

use App\Filament\Admin\Resources\Gestion\Tickets\TicketResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->visible(fn () => Auth::check() && Auth::user()->role === 'admin' || Auth::user()->role === 'proprietaire'|| Auth::user()->role === 'resident'),
        ];
    }
}
