<?php

namespace App\Filament\Admin\Resources\Website\Articles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Titre')
                    ->required(),
                DatePicker::make('date_publication')
                    ->label('Date de publication')
                    ->required(),
                FileUpload::make('image_url')
                    ->label('Image')
                    ->image()
                    ->directory('articles')
                    ->disk('public')
                    ->imageEditor()
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->label('Contenu')
                    ->required()
                    ->columnSpanFull(),
                Select::make('topic_id')
                    ->relationship('topic', 'title')
                    ->label('Catégorie')
                    ->required(),
            ]);
    }
}
