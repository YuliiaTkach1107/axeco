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

class ApartmentResource extends Resource
{
    protected static ?string $model = Apartment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::HomeModern;

    protected static ?string $recordTitleAttribute = 'numero';

    protected static string|UnitEnum|null $navigationGroup = 'Gestion copropriété';

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
}
