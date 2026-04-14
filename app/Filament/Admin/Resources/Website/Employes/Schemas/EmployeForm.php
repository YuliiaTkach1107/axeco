<?php

namespace App\Filament\Admin\Resources\Website\Employes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->required(),
                TextInput::make('prenom')
                    ->label('Prénom')
                    ->required(),
                Select::make('position_id')
                    ->label('Poste')
                    ->relationship('position', 'title')
                    ->required(),
                TextInput::make('email')
                    ->label('Adresse e-mail')
                    ->placeholder('example@gmail.com')
                    ->email(),
                TextInput::make('telephone')
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (! $state) {
                            return;
                        }

                        $clean = preg_replace('/[^\d+]/', '', $state);

                        if (str_starts_with($clean, '0')) {
                            $clean = '+32'.substr($clean, 1);
                        }
                        if (str_starts_with($clean, '+32')) {
                            $numbers = substr($clean, 3);

                            $formatted = '+32 '.
                                substr($numbers, 0, 3).' '.
                                substr($numbers, 3, 2).' '.
                                substr($numbers, 5, 2).' '.
                                substr($numbers, 7, 2);

                            $set('telephone', trim($formatted));
                        }
                    })
                    ->label('Téléphone')
                    ->placeholder('+32 471 23 45 67')
                    ->tel(),
                Select::make('departement_id')
                    ->relationship('departement', 'title')
                    ->label('Département')
                    ->required(),
                FileUpload::make('avatar')
                    ->image()
                    ->label('Photo')
                    ->directory('equipe')
                    ->disk('public')
                    ->imageEditor(),
            ]);
    }
}
