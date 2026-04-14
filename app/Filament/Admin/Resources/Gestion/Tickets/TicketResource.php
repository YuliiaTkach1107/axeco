<?php

namespace App\Filament\Admin\Resources\Gestion\Tickets;

use App\Filament\Admin\Resources\Gestion\Tickets\Pages\CreateTicket;
use App\Filament\Admin\Resources\Gestion\Tickets\Pages\EditTicket;
use App\Filament\Admin\Resources\Gestion\Tickets\Pages\ListTickets;
use App\Filament\Admin\Resources\Gestion\Tickets\Schemas\TicketForm;
use App\Filament\Admin\Resources\Gestion\Tickets\Tables\TicketsTable;
use App\Models\Gestion\Ticket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Inbox;

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|UnitEnum|null $navigationGroup = 'Gestion copropriété';

    protected static ?string $navigationLabel = 'Demandes';

    protected static ?string $pluralModelLabel = 'Demandes';

    protected static ?string $modelLabel = 'demande';

    public static function form(Schema $schema): Schema
    {
        return TicketForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketsTable::configure($table);
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
            'index' => ListTickets::route('/'),
            'create' => CreateTicket::route('/create'),
            'edit' => EditTicket::route('/{record}/edit'),
        ];
    }
}
