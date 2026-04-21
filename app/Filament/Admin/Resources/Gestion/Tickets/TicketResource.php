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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();

        if ($user->role === 'proprietaire') {
            return $query->whereIn('apartment_id', function ($q) use ($user) {
                $q->select('id')
                ->from('apartments')
                ->where('user_id', $user->id);
            });
        }
        if ($user->role === 'contractor') {
            return $query->where('contractor_id', $user->contractor?->id);
        }

        return $query;
    }
    public static function canViewAny(): bool
    {
        return in_array(Auth::user()->role, ['admin', 'proprietaire','contractor','resident']);
    }
    public static function canCreate(): bool
    {
        return in_array(Auth::user()->role, ['admin', 'proprietaire']);
    }
    public static function canEdit($record): bool
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return true;
        }
        if ($user->role === 'proprietaire') {
            return $record->apartment?->user_id === $user->id;
        }
        if ($user->role === 'contractor') {
            return $record->contractor_id === $user->contractor?->id;
        }

        return false;
    }
    public static function canDelete($record): bool
    {
        return Auth::user()->role === 'admin';
    }
    
}
