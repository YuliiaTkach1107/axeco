<?php

use App\Filament\Admin\Resources\Gestion\Announcements\Pages\CreateAnnouncement;
use App\Models\Gestion\Apartment;
use App\Models\Gestion\Building;
use App\Models\Gestion\Resident;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('creating an announcement notifies only users related to the same building', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'role' => 'admin',
    ]);

    $targetBuilding = Building::create([
        'nom' => 'Residence A',
        'adresse' => '1 Rue A',
        'ville' => 'Bruxelles',
        'code_postal' => '1000',
        'nombre_logements' => 10,
    ]);

    $otherBuilding = Building::create([
        'nom' => 'Residence B',
        'adresse' => '2 Rue B',
        'ville' => 'Bruxelles',
        'code_postal' => '1000',
        'nombre_logements' => 8,
    ]);

    $relatedResidentUser = User::factory()->create([
        'email' => 'resident-related@example.com',
        'role' => 'resident',
    ]);

    $unrelatedResidentUser = User::factory()->create([
        'email' => 'resident-unrelated@example.com',
        'role' => 'resident',
    ]);

    $relatedOwnerUser = User::factory()->create([
        'email' => 'owner-related@example.com',
        'role' => 'proprietaire',
    ]);

    $unrelatedOwnerUser = User::factory()->create([
        'email' => 'owner-unrelated@example.com',
        'role' => 'proprietaire',
    ]);

    $relatedApartment = Apartment::create([
        'numero' => 'A1',
        'copropriete_id' => $targetBuilding->id,
        'user_id' => $relatedOwnerUser->id,
        'type' => 'Appartement',
    ]);

    Apartment::create([
        'numero' => 'B1',
        'copropriete_id' => $otherBuilding->id,
        'user_id' => $unrelatedOwnerUser->id,
        'type' => 'Appartement',
    ]);

    Resident::create([
        'nom' => 'Dupont',
        'prenom' => 'Kate',
        'telephone' => '0000000000',
        'email' => $relatedResidentUser->email,
        'copropriete_id' => $targetBuilding->id,
        'appartement_id' => $relatedApartment->id,
        'user_id' => $relatedResidentUser->id,
        'role' => 'locataire',
        'date_entre' => now()->toDateString(),
    ]);

    Resident::create([
        'nom' => 'Martin',
        'prenom' => 'Paul',
        'telephone' => '1111111111',
        'email' => $unrelatedResidentUser->email,
        'copropriete_id' => $otherBuilding->id,
        'appartement_id' => Apartment::create([
            'numero' => 'B2',
            'copropriete_id' => $otherBuilding->id,
            'type' => 'Appartement',
        ])->id,
        'user_id' => $unrelatedResidentUser->id,
        'role' => 'locataire',
        'date_entre' => now()->toDateString(),
    ]);

    $this->actingAs($admin);

    Livewire::test(CreateAnnouncement::class)
        ->fillForm([
            'titre' => 'Travaux de maintenance',
            'contenu' => 'Une intervention est prévue demain.',
            'building_id' => $targetBuilding->id,
            'publie_le' => now(),
            'expire_le' => now()->addWeek(),
            'cree_par' => 'Admin Test',
            'est_actif' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $relatedResidentUser->refresh();
    $unrelatedResidentUser->refresh();
    $relatedOwnerUser->refresh();
    $unrelatedOwnerUser->refresh();

    expect($relatedResidentUser->notifications)->toHaveCount(1);
    expect($relatedResidentUser->notifications->first()->data['title'] ?? null)->toBe('Nouvelle annonce');

    expect($relatedOwnerUser->notifications)->toHaveCount(1);
    expect($relatedOwnerUser->notifications->first()->data['title'] ?? null)->toBe('Nouvelle annonce');

    expect($unrelatedResidentUser->notifications)->toHaveCount(0);
    expect($unrelatedOwnerUser->notifications)->toHaveCount(0);
});
