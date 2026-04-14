<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Widgets\AnnouncementsStats;
use App\Filament\Admin\Widgets\BuildingsStats;
use App\Filament\Admin\Widgets\IntervenantsStats;
use App\Filament\Admin\Widgets\ResidentsStats;
use App\Filament\Admin\Widgets\TicketsStats;
use App\Filament\Widgets\LatestAnnouncements;
use App\Filament\Widgets\LatestTickets;
use App\Filament\Widgets\QuickActions;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => [
                    50 => '#f0f6fc',
                    100 => '#e8f3ff',
                    200 => '#c6e0fa',
                    300 => '#9aa3ae',
                    400 => '#4c6e9a',
                    500 => '#0d4677',
                    600 => '#0a3a63',
                    700 => '#082d4d',
                    800 => '#052138',
                    900 => '#031424',
                    950 => '#010a12',
                ],
                'danger' => Color::rgb('rgb(242, 82, 46)'),
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'gray' => Color::Slate,
            ])
            ->font('Open Sans')
            ->brandName('Axeco Syndic')
            ->brandLogo(asset('images/logo/AXECO_Logo.png'))
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->defaultThemeMode(\Filament\Enums\ThemeMode::Light)
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->topNavigation()
            ->widgets([
                TicketsStats::class,
                AnnouncementsStats::class,
                BuildingsStats::class,
                IntervenantsStats::class,
                ResidentsStats::class,
                LatestTickets::class,
                QuickActions::class,
                LatestAnnouncements::class,
            ])
            // ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->authMiddleware([
                Authenticate::class,
            ]);

    }
}
