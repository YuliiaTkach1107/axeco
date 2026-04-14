<?php

namespace App\Filament\Admin\Resources\Gestion\Contractors;

use App\Filament\Admin\Resources\Gestion\Contractors\Pages\CreateContractor;
use App\Filament\Admin\Resources\Gestion\Contractors\Pages\EditContractor;
use App\Filament\Admin\Resources\Gestion\Contractors\Pages\ListContractors;
use App\Filament\Admin\Resources\Gestion\Contractors\Schemas\ContractorForm;
use App\Filament\Admin\Resources\Gestion\Contractors\Tables\ContractorsTable;
use App\Filament\Clusters\Gestion\Contractors\ContractorsCluster;
use App\Models\Gestion\Contractor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContractorResource extends Resource
{
    protected static ?string $model = Contractor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected static ?string $recordTitleAttribute = 'full_name';

    protected static ?string $cluster = ContractorsCluster::class;

    protected static ?string $navigationLabel = 'Entrepreneurs';

    protected static ?string $pluralModelLabel = 'Entrepreneurs';

    protected static ?string $modelLabel = 'entrepreneur';

    public static function form(Schema $schema): Schema
    {
        return ContractorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContractorsTable::configure($table);
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
            'index' => ListContractors::route('/'),
            'create' => CreateContractor::route('/create'),
            'edit' => EditContractor::route('/{record}/edit'),
        ];
    }
}
