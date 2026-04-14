<?php

namespace App\Filament\Clusters\Gestion\Contractors;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ContractorsCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::WrenchScrewdriver;

    protected static string|UnitEnum|null $navigationGroup = 'Gestion copropriété';

    protected static ?string $navigationLabel = 'Intervenants';

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $clusterBreadcrumb = 'Intervenants';
}
