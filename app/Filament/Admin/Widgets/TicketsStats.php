<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Gestion\Ticket;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class TicketsStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        $query = Ticket::query();

        if ($user->role === 'proprietaire') {
            $query->whereHas('apartment', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }
        if ($user->role === 'contractor') {
            $query->where('contractor_id', $user->contractor->id);
        }

        return [
            Stat::make('Demandes', $query->count())
                ->description('Total des demandes')
                ->color('primary'),
        ];
        // return [
        //     Stat::make('Demandes', '')
        //         ->description('Total des demandes')
        //         ->value(Ticket::count())
        //         ->color('primary'),
        // ];
    }

    protected int|string|array $columnSpan = 1;
}
