<?php

namespace App\Filament\Admin\Resources\Gestion\Specialties;

use App\Filament\Admin\Resources\Gestion\Specialties\Pages\CreateSpecialty;
use App\Filament\Admin\Resources\Gestion\Specialties\Pages\EditSpecialty;
use App\Filament\Admin\Resources\Gestion\Specialties\Pages\ListSpecialties;
use App\Filament\Admin\Resources\Gestion\Specialties\Schemas\SpecialtyForm;
use App\Filament\Admin\Resources\Gestion\Specialties\Tables\SpecialtiesTable;
use App\Filament\Clusters\Gestion\Contractors\ContractorsCluster;
use App\Models\Gestion\Specialty;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class SpecialtyResource extends Resource
{
    protected static ?string $model = Specialty::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AcademicCap;

    protected static ?string $recordTitleAttribute = 'nom';

    protected static ?string $cluster = ContractorsCluster::class;

    protected static ?string $navigationLabel = 'Spécialités';

    protected static ?string $pluralModelLabel = 'Spécialités';

    protected static ?string $modelLabel = 'spécialité';

    public static function form(Schema $schema): Schema
    {
        return SpecialtyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SpecialtiesTable::configure($table);
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
            'index' => ListSpecialties::route('/'),
            'create' => CreateSpecialty::route('/create'),
            'edit' => EditSpecialty::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
    {
        return Auth::user()->role === 'admin';
    }
}
