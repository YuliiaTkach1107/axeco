<?php

namespace App\Filament\Clusters\Website\Articles;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ArticlesCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Newspaper;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Blog et articles';

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
