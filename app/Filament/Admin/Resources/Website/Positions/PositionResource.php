<?php

namespace App\Filament\Admin\Resources\Website\Positions;

use App\Filament\Admin\Resources\Website\Positions\Pages\CreatePosition;
use App\Filament\Admin\Resources\Website\Positions\Pages\EditPosition;
use App\Filament\Admin\Resources\Website\Positions\Pages\ListPositions;
use App\Filament\Admin\Resources\Website\Positions\Schemas\PositionForm;
use App\Filament\Admin\Resources\Website\Positions\Tables\PositionsTable;
use App\Filament\Clusters\Website\Employes\EmployesCluster;
use App\Models\Position;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PositionResource extends Resource
{
    protected static ?string $model = Position::class;

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Briefcase;

    protected static ?string $cluster = EmployesCluster::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Postes';

    protected static ?string $pluralModelLabel = 'Postes';

    protected static ?string $modelLabel = 'poste';

    public static function form(Schema $schema): Schema
    {
        return PositionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PositionsTable::configure($table);
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
            'index' => ListPositions::route('/'),
            'create' => CreatePosition::route('/create'),
            'edit' => EditPosition::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
    {
        return Auth::user()->role === 'admin';
    }
}
