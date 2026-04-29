<?php

namespace App\Filament\Admin\Resources\Website\Details\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DetailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('content')
                    ->label('Contenu')
                    ->required()
                    ->columnSpanFull(),
                Select::make('service_id')
                    ->relationship('service', 'title')
                    ->label('Service')
                    ->required(),
            ]);
    }
}
