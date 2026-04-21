<?php

namespace App\Filament\Admin\Resources\Gestion\Residents;

use App\Filament\Admin\Resources\Gestion\Residents\Pages\CreateResident;
use App\Filament\Admin\Resources\Gestion\Residents\Pages\EditResident;
use App\Filament\Admin\Resources\Gestion\Residents\Pages\ListResidents;
use App\Filament\Admin\Resources\Gestion\Residents\Schemas\ResidentForm;
use App\Filament\Admin\Resources\Gestion\Residents\Tables\ResidentsTable;
use App\Models\Gestion\Resident;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Gestion\Apartment;

class ResidentResource extends Resource
{
    protected static ?string $model = Resident::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $recordTitleAttribute = 'full_name';

    // protected static string|UnitEnum|null $navigationGroup = 'Gestion copropriété';
    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return Auth::user()?->role === 'admin'
            ? 'Gestion copropriété'
            : null;
    }

    // protected static ?string $navigationLabel = 'Résidents';
    public static function getNavigationLabel(): string
    {
        return Auth::user()?->role === 'resident'
            ? 'Mon Profil'
            : 'Résidents';
    }

    // protected static ?string $pluralModelLabel = 'Résidents';
    public static function getPluralModelLabel(): string
    {
        return Auth::user()?->role === 'resident'
            ? 'Mon Profil'
            : 'Résidents';
    }

    protected static ?string $modelLabel = 'résident';

    public static function form(Schema $schema): Schema
    {
        return ResidentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResidentsTable::configure($table);
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
            'index' => ListResidents::route('/'),
            'create' => CreateResident::route('/create'),
            'edit' => EditResident::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        {
            $query = parent::getEloquentQuery();
            $user = Auth::user();

            if ($user->role === 'proprietaire') {
                return $query->whereHas('apartment', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            }
            if (Auth::user()?->role === 'resident') {
                $query->where('user_id', Auth::id());
            }

            return $query;
        }
    }
    public static function canViewAny(): bool
    {
        $user = Auth::user();

        return in_array($user->role, [
            'admin',
            'proprietaire',
            'resident'
        ]);
    }
    public static function canView($record): bool
    {
        $user = Auth::user();

        if ($user->role === 'proprietaire') {

            return Apartment::where('user_id', $user->id)
                ->where('copropriete_id', $record->copropriete_id)
                ->exists();
        }

        return true;
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
