<?php

namespace App\Filament\Admin\Resources\Website\Details;

use App\Filament\Admin\Resources\Website\Details\Pages\CreateDetail;
use App\Filament\Admin\Resources\Website\Details\Pages\EditDetail;
use App\Filament\Admin\Resources\Website\Details\Pages\ListDetails;
use App\Filament\Admin\Resources\Website\Details\Schemas\DetailForm;
use App\Filament\Admin\Resources\Website\Details\Tables\DetailsTable;
use App\Filament\Clusters\Website\Services\ServicesCluster;
use App\Models\Detail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class DetailResource extends Resource
{
    protected static ?string $model = Detail::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ListBullet;

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'content';

    protected static ?string $navigationLabel = 'Détails';

    protected static ?string $pluralModelLabel = 'Détails';

    protected static ?string $modelLabel = 'détail';

    protected static ?string $cluster = ServicesCluster::class;

    public static function form(Schema $schema): Schema
    {
        return DetailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DetailsTable::configure($table);
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
            'index' => ListDetails::route('/'),
            'create' => CreateDetail::route('/create'),
            'edit' => EditDetail::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
    {
        return Auth::user()->role === 'admin';
    }
}
