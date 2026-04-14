<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Gestion\Building;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BuildingsStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Copropriétés', '')
                ->description('Total des copropriétés')
                ->value(Building::count())
                ->color('primary'),
        ];
    }

    protected int|string|array $columnSpan = 1;
}
