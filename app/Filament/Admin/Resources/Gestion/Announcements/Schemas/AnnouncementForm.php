<?php

namespace App\Filament\Admin\Resources\Gestion\Announcements\Schemas;

use Filament\Forms\Components\DateTimePicker;
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
                DateTimePicker::make('publie_le'),
                DateTimePicker::make('expire_le'),
                TextInput::make('cree_par'),
                Toggle::make('est_actif')->default(true)
                    ->required(),
            ]);
    }
}
