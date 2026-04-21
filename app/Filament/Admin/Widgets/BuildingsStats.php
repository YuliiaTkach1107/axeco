<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Gestion\Building;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

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

    public static function canView(): bool
    {
        return !in_array(Auth::user()->role,['proprietaire', 'contractor','resident']);
    }
}
