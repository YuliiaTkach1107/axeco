<?php

namespace App\Filament\Admin\Resources\Website\Contacts;

use App\Filament\Admin\Resources\Website\Contacts\Pages\CreateContact;
use App\Filament\Admin\Resources\Website\Contacts\Pages\EditContact;
use App\Filament\Admin\Resources\Website\Contacts\Pages\ListContacts;
use App\Filament\Admin\Resources\Website\Contacts\Schemas\ContactForm;
use App\Filament\Admin\Resources\Website\Contacts\Tables\ContactsTable;
use App\Models\Contact;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleLeftRight;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ContactForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactsTable::configure($table);
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
            'index' => ListContacts::route('/'),
            'create' => CreateContact::route('/create'),
            'edit' => EditContact::route('/{record}/edit'),
        ];
    }
}
