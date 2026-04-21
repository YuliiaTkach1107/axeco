<?php

namespace App\Filament\Admin\Resources\Gestion\Invitations;

use App\Filament\Admin\Resources\Gestion\Invitations\Pages\CreateInvitation;
use App\Filament\Admin\Resources\Gestion\Invitations\Pages\EditInvitation;
use App\Filament\Admin\Resources\Gestion\Invitations\Pages\ListInvitations;
use App\Filament\Admin\Resources\Gestion\Invitations\Schemas\InvitationForm;
use App\Filament\Admin\Resources\Gestion\Invitations\Tables\InvitationsTable;
use App\Models\Gestion\Invitation;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class InvitationResource extends Resource
{
    protected static ?string $model = Invitation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelopeOpen;

    protected static string|UnitEnum|null $navigationGroup = 'Gestion des utilisateurs';


    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Schema $schema): Schema
    {
        return InvitationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InvitationsTable::configure($table);
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
            'index' => ListInvitations::route('/'),
            'create' => CreateInvitation::route('/create'),
            'edit' => EditInvitation::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
    {
        return Auth::user()->role === 'admin';
    }
}
