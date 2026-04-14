<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Gestion\Ticket;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TicketsStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Demandes', '')
                ->description('Total des demandes')
                ->value(Ticket::count())
                ->color('primary'),
        ];
    }

    protected int|string|array $columnSpan = 1;
}
