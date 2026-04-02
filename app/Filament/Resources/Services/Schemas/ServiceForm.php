<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('icon')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('content')       
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
                    ->image()
                    ->directory('services')
                    ->disk('public')
                    ->required(),
                TextInput::make('accentColor')
                    ->required(),
                TextInput::make('bgColor')
                    ->required(),
                TextInput::make('anchor')
                    ->required(),
                TextInput::make('link')
                    ->required(),
            ]);
    }
}
