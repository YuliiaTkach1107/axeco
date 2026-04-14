<?php

namespace App\Filament\Admin\Resources\Gestion\Tickets\Pages;

use App\Filament\Admin\Resources\Gestion\Tickets\TicketResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;
}
