<?php

namespace App\Filament\Admin\Resources\Website\Employes;

use App\Filament\Admin\Resources\Website\Employes\Pages\CreateEmploye;
use App\Filament\Admin\Resources\Website\Employes\Pages\EditEmploye;
use App\Filament\Admin\Resources\Website\Employes\Pages\ListEmployes;
use App\Filament\Admin\Resources\Website\Employes\Schemas\EmployeForm;
use App\Filament\Admin\Resources\Website\Employes\Tables\EmployesTable;
use App\Filament\Clusters\Website\Employes\EmployesCluster;
use App\Models\Employe;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class EmployeResource extends Resource
{
    protected static ?string $model = Employe::class;

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Identification;

    protected static ?string $cluster = EmployesCluster::class;

    protected static ?string $recordTitleAttribute = 'full_name';

    protected static ?string $navigationLabel = 'Employés';

    protected static ?string $pluralModelLabel = 'Employés';

    protected static ?string $modelLabel = 'employé';

    public static function form(Schema $schema): Schema
    {
        return EmployeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmployesTable::configure($table);
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
            'index' => ListEmployes::route('/'),
            'create' => CreateEmploye::route('/create'),
            'edit' => EditEmploye::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
    {
        return Auth::user()->role === 'admin';
    }
}
