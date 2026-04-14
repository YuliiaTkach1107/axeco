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

class ResidentResource extends Resource
{
    protected static ?string $model = Resident::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $recordTitleAttribute = 'full_name';

    protected static string|UnitEnum|null $navigationGroup = 'Gestion copropriété';

    protected static ?string $navigationLabel = 'Résidents';

    protected static ?string $pluralModelLabel = 'Résidents';

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
}
