<?php

namespace App\Filament\Admin\Resources\Website\FAQS\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FAQForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('question')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('answer')
                    ->label('Réponse')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
