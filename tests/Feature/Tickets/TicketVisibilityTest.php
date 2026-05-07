<?php

use App\Filament\Admin\Resources\Gestion\Tickets\TicketResource;
use App\Models\Gestion\Apartment;
use App\Models\Gestion\Building;
use App\Models\Gestion\Contractor;
use App\Models\Gestion\Resident;
use App\Models\Gestion\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function createBuilding(string $name): Building
{
    return Building::create([
        'nom' => $name,
        'adresse' => "Adresse {$name}",
        'ville' => 'Bruxelles',
        'code_postal' => '1000',
        'nombre_logements' => 10,
    ]);
}

function createApartment(Building $building, string $number, ?int $userId = null): Apartment
{
    return Apartment::create([
        'numero' => $number,
        'copropriete_id' => $building->id,
        'user_id' => $userId,
        'type' => 'Appartement',
    ]);
}

function createResident(User $user, Building $building, Apartment $apartment): Resident
{
    return Resident::create([
        'nom' => 'Dupont',
        'prenom' => 'Kate',
        'telephone' => '0000000000',
        'email' => $user->email,
        'copropriete_id' => $building->id,
        'appartement_id' => $apartment->id,
        'user_id' => $user->id,
        'role' => 'locataire',
        'date_entre' => now()->toDateString(),
    ]);
}

test('contractor sees only assigned tickets', function () {
    $building = createBuilding('Residence Contractor');
    $apartment = createApartment($building, 'A1');

    $residentUser = User::factory()->create([
        'email' => 'resident@example.com',
        'role' => 'resident',
    ]);

    $resident = createResident($residentUser, $building, $apartment);

    $contractorUser = User::factory()->create([
        'email' => 'contractor@example.com',
        'role' => 'contractor',
    ]);

    $otherContractorUser = User::factory()->create([
        'email' => 'contractor-other@example.com',
        'role' => 'contractor',
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

    $otherContractor = Contractor::create([
        'nom' => 'Bernard',
        'prenom' => 'Luc',
        'email' => $otherContractorUser->email,
        'telephone' => null,
        'adresse' => null,
        'ville' => null,
        'code_postal' => null,
        'note' => 0,
        'user_id' => $otherContractorUser->id,
    ]);

    $assignedTicket = Ticket::create([
        'title' => 'Ticket assigne',
        'description' => 'Description 1',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $resident->id,
        'building_id' => $building->id,
        'apartment_id' => $apartment->id,
        'contractor_id' => $contractor->id,
    ]);

    Ticket::create([
        'title' => 'Ticket autre contractor',
        'description' => 'Description 2',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $resident->id,
        'building_id' => $building->id,
        'apartment_id' => $apartment->id,
        'contractor_id' => $otherContractor->id,
    ]);

    Ticket::create([
        'title' => 'Ticket sans contractor',
        'description' => 'Description 3',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $resident->id,
        'building_id' => $building->id,
        'apartment_id' => $apartment->id,
    ]);

    $this->actingAs($contractorUser);

    $visibleIds = TicketResource::getEloquentQuery()->pluck('id')->all();

    expect($visibleIds)->toBe([$assignedTicket->id]);
});

test('resident sees only tickets from own apartment', function () {
    $building = createBuilding('Residence Resident');

    $residentUser = User::factory()->create([
        'email' => 'resident-own@example.com',
        'role' => 'resident',
    ]);

    $otherResidentUser = User::factory()->create([
        'email' => 'resident-other@example.com',
        'role' => 'resident',
    ]);

    $ownApartment = createApartment($building, 'A1');
    $otherApartment = createApartment($building, 'B1');

    $resident = createResident($residentUser, $building, $ownApartment);
    $otherResident = createResident($otherResidentUser, $building, $otherApartment);

    $ownTicket = Ticket::create([
        'title' => 'Ticket appartement resident',
        'description' => 'Description 1',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $resident->id,
        'building_id' => $building->id,
        'apartment_id' => $ownApartment->id,
    ]);

    Ticket::create([
        'title' => 'Ticket autre appartement',
        'description' => 'Description 2',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $otherResident->id,
        'building_id' => $building->id,
        'apartment_id' => $otherApartment->id,
    ]);

    $this->actingAs($residentUser);

    $visibleIds = TicketResource::getEloquentQuery()->pluck('id')->all();

    expect($visibleIds)->toBe([$ownTicket->id]);
});

test('proprietaire sees only tickets from own apartments', function () {
    $building = createBuilding('Residence Owner');

    $ownerUser = User::factory()->create([
        'email' => 'owner@example.com',
        'role' => 'proprietaire',
    ]);

    $otherOwnerUser = User::factory()->create([
        'email' => 'owner-other@example.com',
        'role' => 'proprietaire',
    ]);

    $ownerApartment = createApartment($building, 'A1', $ownerUser->id);
    $otherApartment = createApartment($building, 'B1', $otherOwnerUser->id);

    $residentUser = User::factory()->create([
        'email' => 'resident-ticket@example.com',
        'role' => 'resident',
    ]);

    $otherResidentUser = User::factory()->create([
        'email' => 'resident-ticket-other@example.com',
        'role' => 'resident',
    ]);

    $resident = createResident($residentUser, $building, $ownerApartment);
    $otherResident = createResident($otherResidentUser, $building, $otherApartment);

    $ownerTicket = Ticket::create([
        'title' => 'Ticket appartement proprietaire',
        'description' => 'Description 1',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $resident->id,
        'building_id' => $building->id,
        'apartment_id' => $ownerApartment->id,
    ]);

    Ticket::create([
        'title' => 'Ticket autre proprietaire',
        'description' => 'Description 2',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $otherResident->id,
        'building_id' => $building->id,
        'apartment_id' => $otherApartment->id,
    ]);

    $this->actingAs($ownerUser);

    $visibleIds = TicketResource::getEloquentQuery()->pluck('id')->all();

    expect($visibleIds)->toBe([$ownerTicket->id]);
});
