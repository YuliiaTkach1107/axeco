<?php

namespace App\Filament\Admin\Resources\Website\Services\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Titre')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('icon')
                    ->label('Icône')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Contenu')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'bulletList',
                        'link',
                        'redo',
                        'undo',
                    ]),
                FileUpload::make('image_url')
                    ->label('Image')
                    ->image()
                    ->directory('services')
                    ->disk('public')
                    ->imageEditor()
                    ->required(),
                ColorPicker::make('accentColor')
                    ->label('Couleur d’accent')
                    ->required(),
                ColorPicker::make('bgColor')
                    ->label('Couleur de fond')
                    ->required(),
                TextInput::make('anchor')
                    ->label('Ancre')
                    ->required(),
                TextInput::make('link')
                    ->label('Lien (URL)')
                    ->required(),
            ]);
    }
}
