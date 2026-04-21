<?php

namespace App\Filament\Admin\Resources\Gestion\Apartments;

use App\Filament\Admin\Resources\Gestion\Apartments\Pages\CreateApartment;
use App\Filament\Admin\Resources\Gestion\Apartments\Pages\EditApartment;
use App\Filament\Admin\Resources\Gestion\Apartments\Pages\ListApartments;
use App\Filament\Admin\Resources\Gestion\Apartments\Schemas\ApartmentForm;
use App\Filament\Admin\Resources\Gestion\Apartments\Tables\ApartmentsTable;
use App\Models\Gestion\Apartment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ApartmentResource extends Resource
{
    protected static ?string $model = Apartment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::HomeModern;

    protected static ?string $recordTitleAttribute = 'numero';

    // protected static string|UnitEnum|null $navigationGroup = 'Gestion copropriété';
    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return Auth::user()?->role === 'admin'
            ? 'Gestion copropriété'
            : null;
    }
    protected static ?string $navigationLabel = 'Appartements';

    protected static ?string $pluralModelLabel = 'Appartements';

    protected static ?string $modelLabel = 'appartement';

    public static function form(Schema $schema): Schema
    {
        return ApartmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApartmentsTable::configure($table);
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
            'index' => ListApartments::route('/'),
            'create' => CreateApartment::route('/create'),
            'edit' => EditApartment::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();

        if ($user->role === 'proprietaire') {
            return $query->where('user_id', $user->id);
        }

        return $query;
    }
    public static function canView($record): bool
    {
        $user = Auth::user();

        if ($user->role === 'proprietaire') {
            return $record->user_id === $user->id;
        }

        return true;
    }
    public static function canViewAny(): bool
    {
        $user = Auth::user();

        return in_array($user->role, ['admin', 'proprietaire']);
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
