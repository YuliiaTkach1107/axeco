<?php

namespace App\Filament\Admin\Resources\Gestion\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nom')
                    ->required(),
                TextInput::make('email')
                    ->label('Adresse e-mail')
                    ->email()
                    ->required(),
                Select::make('role')
                    ->label('Rôle')
                    ->options([
                        'admin' => 'Admin',
                        'proprietaire' => 'Propriétaire',
                        'resident' => 'Resident',
                        'contractor'=>'Entrepreneur'
                    ])
                    ->default('resident')
                    ->required(),
            ]);
    }
}
