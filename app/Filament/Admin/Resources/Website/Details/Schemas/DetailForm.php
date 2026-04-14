<?php

namespace App\Filament\Resources\Details\Schemas;


use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class DetailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                 Select::make('service_id')
                    ->relationship('service', 'title') 
                    ->label('Service')
                    ->required(),
            ]);
    }
}
