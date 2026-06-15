<?php

namespace App\Filament\Admin\Resources\Gestion\Announcements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required(),
                Textarea::make('contenu')
                    ->required()
                    ->columnSpanFull(),
                Select::make('building_id')
                    ->label('Copropriété')
                    ->relationship('building', 'nom')
                    ->required(),
                DatePicker::make('publie_le')->label('Publié le'),
                DatePicker::make('expire_le')->label('Expire le'),
                TextInput::make('cree_par')->label('Créé par'),
                Toggle::make('est_actif')->default(true)
                    ->required(),
            ]);
    }
}
