<?php

namespace App\Filament\Resources\Valeurs;

use App\Filament\Resources\Valeurs\Pages\CreateValeur;
use App\Filament\Resources\Valeurs\Pages\EditValeur;
use App\Filament\Resources\Valeurs\Pages\ListValeurs;
use App\Filament\Resources\Valeurs\Schemas\ValeurForm;
use App\Filament\Resources\Valeurs\Tables\ValeursTable;
use App\Models\Valeur;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ValeurResource extends Resource
{
    protected static ?string $model = Valeur::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Valeur';

    public static function form(Schema $schema): Schema
    {
        return ValeurForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ValeursTable::configure($table);
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
            'index' => ListValeurs::route('/'),
            'create' => CreateValeur::route('/create'),
            'edit' => EditValeur::route('/{record}/edit'),
        ];
    }
}
