<?php

namespace App\Filament\Admin\Resources\Gestion\Tickets\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use App\Models\Gestion\Apartment;
use App\Models\Gestion\Resident;
use Filament\Schemas\Components\Utilities\Get;
use App\Models\Gestion\Contractor;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->hidden(fn () => Auth::user()->role === 'contractor'),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull()
                    ->hidden(fn () => Auth::user()->role === 'contractor'),
                Select::make('statut')
                    ->required()
                    ->options([
                        'ouvert' => 'Ouvert',
                        'en_cours' => 'En cours',
                        'résolu' => 'Résolu',
                        'fermé' => 'Fermé',
                    ])
                    ->default('ouvert')
                    ->visible(fn () => in_array(Auth::user()?->role, ['admin', 'contractor'])),
                Select::make('priorite')
                    ->label('Priorité')
                    ->options([
                        'faible' => 'Faible',
                        'moyenne' => 'Moyenne',
                        'élevée' => 'Élevée',
                        'urgente' => 'Urgente',
                    ])
                    ->required()
                    ->default('moyenne')
                    ->hidden(fn () => Auth::user()->role === 'contractor')
                    ->disabled(fn ($record) =>$record && in_array(Auth::user()?->role, ['proprietaire', 'resident'])),
                Select::make('building_id')
                    ->label('Copropriété')
                    ->relationship(
                        name: 'building',
                        titleAttribute: 'nom',
                        modifyQueryUsing: function ($query) {
                        $user = Auth::user();

                        if ($user->role === 'proprietaire') {
                        return $query->whereExists(function ($sub) use ($user) {
                        $sub->selectRaw(1)
                            ->from('apartments')
                            ->whereColumn('apartments.copropriete_id', 'buildings.id')
                            ->where('apartments.user_id', $user->id);
                    });
                        }

                        return $query;
                    })
                    ->reactive()
                    ->required()
                    ->preload()
                    ->searchable()
                    ->hidden(fn () => Auth::user()->role === 'contractor')
                    ->disabled(fn ($record) =>$record && in_array(Auth::user()?->role, ['proprietaire', 'resident'])),
                Select::make('apartment_id')
                    ->label('Appartement')
                    ->relationship('apartment', 'numero')
                    ->options(function (callable $get) {
                        $user = Auth::user();
                        $buildingId = $get('building_id');
                        $query = Apartment::query();
                        if ($user->role === 'proprietaire') {
                            $query->where('user_id', $user->id);
                        }
                        if ($buildingId) {
                            $query->where('copropriete_id', $buildingId);
                        }
                        return $query->pluck('numero', 'id');
                    })
                    ->reactive()
                    ->preload()
                    ->searchable()
                    ->hidden(fn () => Auth::user()->role === 'contractor')
                    ->disabled(fn ($record) =>$record && in_array(Auth::user()?->role, ['proprietaire', 'resident'])),
                Select::make('resident_id')
                    ->required()
                    ->label('Résident')
                    ->relationship('resident', 'nom')
                    ->preload()
                    ->searchable()
                    ->options(function (Get $get) {
                        $apartmentId = $get('apartment_id');
                        if (! $apartmentId) {
                            return [];
                        }
                        return Resident::query()
                            ->where('appartement_id', $apartmentId)
                            ->get()
                            ->mapWithKeys(fn ($r) => [
                                $r->id => $r->nom . ' ' . $r->prenom,
                            ])
                            ->toArray();
                    })
                    ->hidden(fn () => Auth::user()->role === 'contractor')
                    ->disabled(fn ($record) =>$record && in_array(Auth::user()?->role, ['proprietaire', 'resident'])),
                Select::make('contractor_id')
                    ->label('Entrepreneur')
                    ->relationship('contractor', 'nom')
                    ->visible(fn () => Auth::user()->role === 'admin')
                    ->options(function (Get $get) {
                        return Contractor::query()
                            ->get()
                            ->mapWithKeys(fn ($r) => [
                                $r->id => $r->nom . ' ' . $r->prenom,
                            ])
                            ->toArray();
                        })
                    ->preload()
                    ->searchable(),
                Textarea::make('note_contractor')
                    ->visible(fn () => Auth::user()->role === 'contractor') 
                    ->label('Note du technicien'),
                Textarea::make('note_admin')
                    ->label('Note de l\'administrateur')
                    ->visible(fn () => Auth::user()->role === 'admin'),
                DateTimePicker::make('assigne_le')->label('Assigné le') ->visible(fn () => Auth::user()?->role === 'admin'),
                DateTimePicker::make('resolu_le')->label('Résolu le') ->visible(fn () => Auth::user()?->role === 'admin'),
                    ]);
            }
}
