<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Gestion\Resident;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ResidentsStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Résidents', Resident::count())
                ->description('Total des résidents')
                ->color('primary'),
        ];
    }

    protected int|string|array $columnSpan = 1;
}
