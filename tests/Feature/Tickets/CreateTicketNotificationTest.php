<?php

use App\Filament\Admin\Resources\Gestion\Tickets\Pages\CreateTicket;
use App\Filament\Admin\Resources\Gestion\Tickets\Pages\EditTicket;
use App\Models\Gestion\Apartment;
use App\Models\Gestion\Building;
use App\Models\Gestion\Contractor;
use App\Models\Gestion\Resident;
use App\Models\Gestion\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('resident creating a ticket sends a database notification to admin', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'role' => 'admin',
    ]);

    $residentUser = User::factory()->create([
        'email' => 'resident@example.com',
        'role' => 'resident',
    ]);

    $building = Building::create([
        'nom' => 'Residence Test',
        'adresse' => '1 Rue de Test',
        'ville' => 'Bruxelles',
        'code_postal' => '1000',
        'nombre_logements' => 10,
    ]);

    $apartment = Apartment::create([
        'numero' => 'A1',
        'copropriete_id' => $building->id,
        'user_id' => $residentUser->id,
        'type' => 'Appartement',
    ]);

    $resident = Resident::create([
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

    $this->actingAs($residentUser);

    Livewire::test(CreateTicket::class)
        ->fillForm([
            'title' => 'Fuite d eau',
            'description' => 'Il y a une fuite dans la cuisine.',
            'priorite' => 'moyenne',
            'building_id' => $building->id,
            'apartment_id' => $apartment->id,
            'resident_id' => $resident->id,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $ticket = \App\Models\Gestion\Ticket::query()->first();

    expect($ticket)->not->toBeNull();
    expect($ticket->title)->toBe('Fuite d eau');
    expect($ticket->resident_id)->toBe($resident->id);
    expect($ticket->building_id)->toBe($building->id);
    expect($ticket->apartment_id)->toBe($apartment->id);

    $admin->refresh();

    expect($admin->notifications)->toHaveCount(1);
    expect($admin->notifications->first()->data['title'] ?? null)->toBe('Nouvelle demande');
});

test('assigning a contractor to a ticket sends a database notification to that contractor', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'role' => 'admin',
    ]);

    $residentUser = User::factory()->create([
        'email' => 'resident@example.com',
        'role' => 'resident',
    ]);

    $contractorUser = User::factory()->create([
        'email' => 'contractor@example.com',
        'role' => 'contractor',
    ]);

    $building = Building::create([
        'nom' => 'Residence Test',
        'adresse' => '1 Rue de Test',
        'ville' => 'Bruxelles',
        'code_postal' => '1000',
        'nombre_logements' => 10,
    ]);

    $apartment = Apartment::create([
        'numero' => 'A1',
        'copropriete_id' => $building->id,
        'user_id' => $residentUser->id,
        'type' => 'Appartement',
    ]);

    $resident = Resident::create([
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

    $contractor = Contractor::create([
        'nom' => 'Martin',
        'prenom' => 'Paul',
        'email' => $contractorUser->email,
        'telephone' => null,
        'adresse' => null,
        'ville' => null,
        'code_postal' => null,
        'note' => 0,
        'user_id' => $contractorUser->id,
    ]);

    $ticket = Ticket::create([
        'title' => 'Fuite d eau',
        'description' => 'Il y a une fuite dans la cuisine.',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $resident->id,
        'building_id' => $building->id,
        'apartment_id' => $apartment->id,
    ]);

    $this->actingAs($admin);

    Livewire::test(EditTicket::class, ['record' => $ticket->getKey()])
        ->fillForm([
            'title' => $ticket->title,
            'description' => $ticket->description,
            'statut' => $ticket->statut,
            'priorite' => $ticket->priorite,
            'building_id' => $building->id,
            'apartment_id' => $apartment->id,
            'resident_id' => $resident->id,
            'contractor_id' => $contractor->id,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $ticket->refresh();
    $contractorUser->refresh();

    expect($ticket->contractor_id)->toBe($contractor->id);
    expect($contractorUser->notifications)->toHaveCount(1);
    expect($contractorUser->notifications->first()->data['title'] ?? null)->toBe('Nouvelle demande assignée');
});
