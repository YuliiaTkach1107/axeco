<?php

namespace App\Filament\Clusters\Website\Employes;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Support\Icons\Heroicon;
use UnitEnum;
use Illuminate\Support\Facades\Auth;

class EmployesCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Users;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Notre équipe';

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $clusterBreadcrumb = 'Employés';

    public static function canAccess(): bool
    {
        return Auth::user()->role === 'admin';
    }
}
