<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Gestion\Contractor;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class IntervenantsStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Entrepreneurs', Contractor::count())
                ->description('Total des entrepreneurs')
                ->color('primary'),
        ];
    }

    protected int|string|array $columnSpan = 1;
}
