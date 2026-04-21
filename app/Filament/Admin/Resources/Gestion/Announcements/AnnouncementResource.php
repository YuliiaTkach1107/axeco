<?php

namespace App\Filament\Admin\Resources\Gestion\Announcements;

use App\Filament\Admin\Resources\Gestion\Announcements\Pages\CreateAnnouncement;
use App\Filament\Admin\Resources\Gestion\Announcements\Pages\EditAnnouncement;
use App\Filament\Admin\Resources\Gestion\Announcements\Pages\ListAnnouncements;
use App\Filament\Admin\Resources\Gestion\Announcements\Schemas\AnnouncementForm;
use App\Filament\Admin\Resources\Gestion\Announcements\Tables\AnnouncementsTable;
use App\Models\Gestion\Announcement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AnnouncementResource extends Resource
{

    protected static ?string $model = Announcement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Megaphone;

    protected static ?string $recordTitleAttribute = 'titre';

    protected static string|UnitEnum|null $navigationGroup = 'Gestion copropriété';

    protected static ?string $navigationLabel = 'Annonces';

    protected static ?string $pluralModelLabel = 'Annonces';

    protected static ?string $modelLabel = 'annonce';

    public static function form(Schema $schema): Schema
    {
        return AnnouncementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnnouncementsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAnnouncements::route('/'),
            'create' => CreateAnnouncement::route('/create'),
            'edit' => EditAnnouncement::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();

        if ($user->role === 'proprietaire') {
            return $query->whereIn('building_id', function ($sub) use ($user) {
                $sub->select('copropriete_id')
                    ->from('apartments')
                    ->where('user_id', $user->id);
            });
        }

        return $query;
    }
    public static function canViewAny(): bool
    {
        return in_array(Auth::user()->role, ['admin', 'proprietaire', 'resident']);
    }
    public static function canAccess(): bool
    {
        return in_array(Auth::user()->role, ['admin', 'proprietaire']);
    }
    public static function canCreate(): bool
    {
        return Auth::user()->role === 'admin';
    }

    public static function canEdit($record): bool
    {
        return Auth::user()->role === 'admin';
    }

    public static function canDelete($record): bool
    {
        return Auth::user()->role === 'admin';
    }
}
