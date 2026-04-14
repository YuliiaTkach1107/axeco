<?php

namespace App\Filament\Resources\Employes;

use App\Filament\Resources\Employes\Pages\CreateEmploye;
use App\Filament\Resources\Employes\Pages\EditEmploye;
use App\Filament\Resources\Employes\Pages\ListEmployes;
use App\Filament\Resources\Employes\Schemas\EmployeForm;
use App\Filament\Resources\Employes\Tables\EmployesTable;
use App\Models\Employe;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EmployeResource extends Resource
{
    protected static ?string $model = Employe::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static  string|UnitEnum|null  $navigationGroup = 'Notre équipe';


    protected static ?string $recordTitleAttribute = 'Employes';

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
}
