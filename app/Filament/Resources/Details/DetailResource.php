<?php

namespace App\Filament\Resources\Details;

use App\Filament\Resources\Details\Pages\CreateDetail;
use App\Filament\Resources\Details\Pages\EditDetail;
use App\Filament\Resources\Details\Pages\ListDetails;
use App\Filament\Resources\Details\Schemas\DetailForm;
use App\Filament\Resources\Details\Tables\DetailsTable;
use App\Models\Detail;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;

class DetailResource extends Resource
{
    protected static ?string $model = Detail::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Detail';
    protected static  string|UnitEnum|null  $navigationGroup = 'Services';


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

}
