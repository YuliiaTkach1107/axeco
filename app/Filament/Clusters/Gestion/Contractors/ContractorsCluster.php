<?php

namespace App\Filament\Clusters\Gestion\Contractors;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Support\Icons\Heroicon;
use UnitEnum;
use Illuminate\Support\Facades\Auth;

class ContractorsCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::WrenchScrewdriver;

    public static function getNavigationGroup(): string|UnitEnum|null
        {
            return Auth::user()?->role === 'admin'
                ? 'Gestion copropriété'
                : null;
        }
    public static function getNavigationLabel(): string
        {
            return Auth::user()?->role === 'admin'
                    ? 'Intervenants'
                    : 'Mon profil';
        }
    

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $clusterBreadcrumb = 'Intervenants';
}
