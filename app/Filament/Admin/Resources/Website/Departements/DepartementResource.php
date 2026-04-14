<?php

namespace App\Filament\Admin\Resources\Website\Departements;

use App\Filament\Admin\Resources\Website\Departements\Pages\CreateDepartement;
use App\Filament\Admin\Resources\Website\Departements\Pages\EditDepartement;
use App\Filament\Admin\Resources\Website\Departements\Pages\ListDepartements;
use App\Filament\Admin\Resources\Website\Departements\Schemas\DepartementForm;
use App\Filament\Admin\Resources\Website\Departements\Tables\DepartementsTable;
use App\Filament\Clusters\Website\Employes\EmployesCluster;
use App\Models\Departement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DepartementResource extends Resource
{
    protected static ?string $model = Departement::class;

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice2;

    protected static ?string $cluster = EmployesCluster::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Départements';

    protected static ?string $pluralModelLabel = 'Départements';

    protected static ?string $modelLabel = 'département';

    public static function form(Schema $schema): Schema
    {
        return DepartementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DepartementsTable::configure($table);
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
            'index' => ListDepartements::route('/'),
            'create' => CreateDepartement::route('/create'),
            'edit' => EditDepartement::route('/{record}/edit'),
        ];
    }
}
