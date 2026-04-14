<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Gestion\Announcement;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AnnouncementsStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {

        return [
            Stat::make('Annonces', Announcement::count())
                ->description('Total des annonces')
                ->color('primary'),
        ];
    }

    protected int|string|array $columnSpan = 1;
}
