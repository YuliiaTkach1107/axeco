<?php

namespace App\Filament\Admin\Resources\Gestion\Documents;

use App\Filament\Admin\Resources\Gestion\Documents\Pages\CreateDocument;
use App\Filament\Admin\Resources\Gestion\Documents\Pages\EditDocument;
use App\Filament\Admin\Resources\Gestion\Documents\Pages\ListDocuments;
use App\Filament\Admin\Resources\Gestion\Documents\Schemas\DocumentForm;
use App\Filament\Admin\Resources\Gestion\Documents\Tables\DocumentsTable;
use App\Models\Gestion\Document;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Gestion\Apartment;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocument;

    protected static ?string $recordTitleAttribute = 'titre';
    // protected static string|UnitEnum|null $navigationGroup = 'Gestion copropriété';

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return Auth::user()?->role === 'admin'
            ? 'Gestion copropriété'
            : null;
    }
    public static function form(Schema $schema): Schema
    {
        return DocumentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DocumentsTable::configure($table);
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
            'index' => ListDocuments::route('/'),
            'create' => CreateDocument::route('/create'),
            'edit' => EditDocument::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();

        if ($user->role === 'proprietaire') {
            $buildingIds = Apartment::where('user_id', $user->id)
            ->pluck('copropriete_id');

            return $query->where(function ($q) use ($user, $buildingIds) {

                $q->where(function ($q1) use ($buildingIds) {
                    $q1->where('type', 'building')
                    ->whereIn('building_id', $buildingIds);
                })

                ->orWhere(function ($q2) use ($user) {
                    $q2->where('type', 'personal')
                    ->where('user_id', $user->id);
                })

                ->orWhere('type', 'public');
            });
        }

        if ($user?->role === 'resident' && $user->resident) {
            $residentId = $user->resident->id;
            return $query->where(function ($q) use ($residentId) {
                $q->where('type', 'public')
                
                ->orWhere(function ($q) use ($residentId) {
                    $q->where('type', 'personal')
                        ->where('resident_id', $residentId);
                });
            });
        }

        return $query;
    }
        // $query = parent::getEloquentQuery();
        // $user = Auth::user();

        // if ($user->role === 'proprietaire') {
        //     return $query->where('building_id', $user->building_id);
        // }

        // return $query;
    
    public static function canViewAny(): bool
    {
        return in_array(Auth::user()->role, ['admin', 'proprietaire','resident']);
    }
    public static function canCreate(): bool
    {
        return Auth::user()?->role === 'admin';
    }

    public static function canEdit($record): bool
    {
        return Auth::user()?->role === 'admin';
    }

    public static function canDelete($record): bool
    {
        return Auth::user()?->role === 'admin';
    }
}
