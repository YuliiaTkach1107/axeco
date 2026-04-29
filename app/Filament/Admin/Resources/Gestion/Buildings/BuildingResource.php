<?php

namespace App\Filament\Admin\Resources\Gestion\Buildings;

use App\Filament\Admin\Resources\Gestion\Buildings\Pages\CreateBuilding;
use App\Filament\Admin\Resources\Gestion\Buildings\Pages\EditBuilding;
use App\Filament\Admin\Resources\Gestion\Buildings\Pages\ListBuildings;
use App\Filament\Admin\Resources\Gestion\Buildings\Schemas\BuildingForm;
use App\Filament\Admin\Resources\Gestion\Buildings\Tables\BuildingsTable;
use App\Models\Gestion\Building;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Support\Facades\Auth;

class BuildingResource extends Resource
{
    protected static ?string $model = Building::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice;

    protected static ?string $recordTitleAttribute = 'nom';

    protected static string|UnitEnum|null $navigationGroup = 'Gestion copropriété';

    protected static ?string $navigationLabel = 'Copropriétés';

    protected static ?string $pluralModelLabel = 'Copropriétés';

    protected static ?string $modelLabel = 'copropriété';

    public static function form(Schema $schema): Schema
    {
        return BuildingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BuildingsTable::configure($table);
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
            'index' => ListBuildings::route('/'),
            'create' => CreateBuilding::route('/create'),
            'edit' => EditBuilding::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
    {
        return Auth::user()->role === 'admin';
        
    }
}
