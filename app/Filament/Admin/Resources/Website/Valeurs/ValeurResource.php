<?php

namespace App\Filament\Admin\Resources\Website\Valeurs;

use App\Filament\Admin\Resources\Website\Valeurs\Pages\CreateValeur;
use App\Filament\Admin\Resources\Website\Valeurs\Pages\EditValeur;
use App\Filament\Admin\Resources\Website\Valeurs\Pages\ListValeurs;
use App\Filament\Admin\Resources\Website\Valeurs\Schemas\ValeurForm;
use App\Filament\Admin\Resources\Website\Valeurs\Tables\ValeursTable;
use App\Models\Valeur;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Support\Facades\Auth;

class ValeurResource extends Resource
{
    protected static ?string $model = Valeur::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShieldCheck;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?string $recordTitleAttribute = 'title';

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
    public static function canViewAny(): bool
    {
        return Auth::user()->role === 'admin';
    }
}
