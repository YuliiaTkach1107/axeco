<?php

namespace App\Filament\Clusters\Website\Services;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ServicesCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::RectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Gestion des services';

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
}
