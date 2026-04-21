<?php

namespace App\Filament\Admin\Resources\Website\Topics;

use App\Filament\Admin\Resources\Website\Topics\Pages\CreateTopic;
use App\Filament\Admin\Resources\Website\Topics\Pages\EditTopic;
use App\Filament\Admin\Resources\Website\Topics\Pages\ListTopics;
use App\Filament\Admin\Resources\Website\Topics\Schemas\TopicForm;
use App\Filament\Admin\Resources\Website\Topics\Tables\TopicsTable;
use App\Filament\Clusters\Website\Articles\ArticlesCluster;
use App\Models\Topic;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class TopicResource extends Resource
{
    protected static ?string $model = Topic::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Tag;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Catégories';

    protected static ?string $pluralModelLabel = 'Catégories';

    protected static ?string $modelLabel = 'catégorie';

    protected static ?string $cluster = ArticlesCluster::class;

    public static function form(Schema $schema): Schema
    {
        return TopicForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TopicsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTopics::route('/'),
            'create' => CreateTopic::route('/create'),
            'edit' => EditTopic::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
    {
        return Auth::user()->role === 'admin';
    }
}
