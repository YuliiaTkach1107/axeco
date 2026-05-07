<?php

use App\Filament\Admin\Resources\Gestion\Documents\DocumentResource;
use App\Models\Gestion\Apartment;
use App\Models\Gestion\Building;
use App\Models\Gestion\Document;
use App\Models\Gestion\Resident;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('resident can load visible documents query and document type automation works', function () {
    $building = Building::create([
        'nom' => 'Residence Documents',
        'adresse' => '1 Rue des Documents',
        'ville' => 'Bruxelles',
        'code_postal' => '1000',
        'nombre_logements' => 10,
    ]);

    $residentUser = User::factory()->create([
        'email' => 'resident-documents@example.com',
        'role' => 'resident',
    ]);

    $apartment = Apartment::create([
        'numero' => 'A1',
        'copropriete_id' => $building->id,
        'type' => 'Appartement',
    ]);

    Resident::create([
        'nom' => 'Dupont',
        'prenom' => 'Kate',
        'telephone' => '0000000000',
        'email' => $residentUser->email,
        'copropriete_id' => $building->id,
        'appartement_id' => $apartment->id,
        'user_id' => $residentUser->id,
        'role' => 'locataire',
        'date_entre' => now()->toDateString(),
    ]);

    $publicDocument = Document::create([
        'titre' => 'Document public',
        'description' => 'Visible par tous',
        'fichier_lien' => 'documents/public.pdf',
        'type' => 'public',
        'category' => 'reglement',
        'building_id' => null,
        'user_id' => null,
    ]);

    $personalDocument = Document::create([
        'titre' => 'Document personnel',
        'description' => 'Visible par le resident',
        'fichier_lien' => 'documents/personal.pdf',
        'type' => 'personal',
        'category' => 'facture',
        'building_id' => $building->id,
        'user_id' => $residentUser->id,
    ]);

    $buildingDocument = Document::create([
        'titre' => 'Document copropriete',
        'description' => 'Visible pour la copropriete',
        'fichier_lien' => 'documents/building.pdf',
        'type' => 'building',
        'category' => 'contrat',
        'building_id' => $building->id,
        'user_id' => $residentUser->id,
    ]);

    $publicDocument->refresh();
    $personalDocument->refresh();
    $buildingDocument->refresh();

    expect($publicDocument->building_id)->toBeNull();
    expect($publicDocument->user_id)->toBeNull();
    expect((bool) $publicDocument->est_public)->toBeTrue();

    expect($personalDocument->user_id)->toBe($residentUser->id);
    expect($personalDocument->building_id)->toBe($building->id);
    expect((bool) $personalDocument->est_public)->toBeFalse();

    expect($buildingDocument->building_id)->toBe($building->id);
    expect($buildingDocument->user_id)->toBeNull();
    expect((bool) $buildingDocument->est_public)->toBeFalse();

    $this->actingAs($residentUser);

    $visibleIds = DocumentResource::getEloquentQuery()->pluck('id')->all();

    expect($visibleIds)->toContain($publicDocument->id);
    expect($visibleIds)->toContain($personalDocument->id);
    expect($visibleIds)->not->toContain($buildingDocument->id);
});
