<?php

namespace App\Filament\Admin\Resources\Gestion\Invitations\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class InvitationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->unique()
                    ->default(fn () => strtoupper(str()->random(8)))
                    ->required(),
                Select::make('role')
                    ->label('Rôle')
                    ->options([
                        'resident' => 'Résident',
                        'proprietaire' => 'Propriétaire',
                        'contractor' => 'Entrepreneur',
                        'admin' => 'Admin',
                    ])
                    ->required(),
                DateTimePicker::make('used_at')->label('Utilisé le')->disabled(),
            ]);
    }
}
