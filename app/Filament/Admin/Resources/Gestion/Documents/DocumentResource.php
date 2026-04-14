<?php

namespace App\Filament\Admin\Resources\Gestion\Documents;

use App\Filament\Admin\Resources\Gestion\Documents\Pages\CreateDocument;
use App\Filament\Admin\Resources\Gestion\Documents\Pages\EditDocument;
use App\Filament\Admin\Resources\Gestion\Documents\Pages\ListDocuments;
use App\Filament\Admin\Resources\Gestion\Documents\Schemas\DocumentForm;
use App\Filament\Admin\Resources\Gestion\Documents\Tables\DocumentsTable;
use App\Models\Gestion\Document;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocument;

    protected static ?string $recordTitleAttribute = 'titre';
    protected static string|UnitEnum|null $navigationGroup = 'Gestion copropriété';

    public static function form(Schema $schema): Schema
    {
        return DocumentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DocumentsTable::configure($table);
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
            'index' => ListDocuments::route('/'),
            'create' => CreateDocument::route('/create'),
            'edit' => EditDocument::route('/{record}/edit'),
        ];
    }
}
