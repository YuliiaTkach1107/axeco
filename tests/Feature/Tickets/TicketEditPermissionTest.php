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

function createPermissionBuilding(string $name): Building
{
    return Building::create([
        'nom' => $name,
        'adresse' => "Adresse {$name}",
        'ville' => 'Bruxelles',
        'code_postal' => '1000',
        'nombre_logements' => 10,
    ]);
}

function createPermissionApartment(Building $building, string $number, ?int $userId = null): Apartment
{
    return Apartment::create([
        'numero' => $number,
        'copropriete_id' => $building->id,
        'user_id' => $userId,
        'type' => 'Appartement',
    ]);
}

function createPermissionResident(User $user, Building $building, Apartment $apartment): Resident
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

test('admin can edit any ticket', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $building = createPermissionBuilding('Residence Admin');
    $apartment = createPermissionApartment($building, 'A1');
    $residentUser = User::factory()->create(['role' => 'resident']);
    $resident = createPermissionResident($residentUser, $building, $apartment);

    $ticket = Ticket::create([
        'title' => 'Ticket Admin',
        'description' => 'Description',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $resident->id,
        'building_id' => $building->id,
        'apartment_id' => $apartment->id,
    ]);

    $this->actingAs($admin);

    expect(TicketResource::canEdit($ticket))->toBeTrue();
});

test('contractor can edit only assigned tickets', function () {
    $building = createPermissionBuilding('Residence Contractor');
    $apartment = createPermissionApartment($building, 'A1');

    $residentUser = User::factory()->create(['role' => 'resident']);
    $resident = createPermissionResident($residentUser, $building, $apartment);

    $contractorUser = User::factory()->create(['role' => 'contractor']);
    $otherContractorUser = User::factory()->create(['role' => 'contractor']);

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
        'title' => 'Assigned ticket',
        'description' => 'Description',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $resident->id,
        'building_id' => $building->id,
        'apartment_id' => $apartment->id,
        'contractor_id' => $contractor->id,
    ]);

    $otherTicket = Ticket::create([
        'title' => 'Other ticket',
        'description' => 'Description',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $resident->id,
        'building_id' => $building->id,
        'apartment_id' => $apartment->id,
        'contractor_id' => $otherContractor->id,
    ]);

    $this->actingAs($contractorUser);

    expect(TicketResource::canEdit($assignedTicket))->toBeTrue();
    expect(TicketResource::canEdit($otherTicket))->toBeFalse();
});

test('resident can edit only tickets from own apartment', function () {
    $building = createPermissionBuilding('Residence Resident');

    $residentUser = User::factory()->create(['role' => 'resident']);
    $otherResidentUser = User::factory()->create(['role' => 'resident']);

    $ownApartment = createPermissionApartment($building, 'A1');
    $otherApartment = createPermissionApartment($building, 'B1');

    $resident = createPermissionResident($residentUser, $building, $ownApartment);
    $otherResident = createPermissionResident($otherResidentUser, $building, $otherApartment);

    $ownTicket = Ticket::create([
        'title' => 'Own ticket',
        'description' => 'Description',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $resident->id,
        'building_id' => $building->id,
        'apartment_id' => $ownApartment->id,
    ]);

    $otherTicket = Ticket::create([
        'title' => 'Other ticket',
        'description' => 'Description',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $otherResident->id,
        'building_id' => $building->id,
        'apartment_id' => $otherApartment->id,
    ]);

    $this->actingAs($residentUser);

    expect(TicketResource::canEdit($ownTicket))->toBeTrue();
    expect(TicketResource::canEdit($otherTicket))->toBeFalse();
});

test('proprietaire can edit only tickets from own apartments', function () {
    $building = createPermissionBuilding('Residence Owner');

    $ownerUser = User::factory()->create(['role' => 'proprietaire']);
    $otherOwnerUser = User::factory()->create(['role' => 'proprietaire']);

    $ownerApartment = createPermissionApartment($building, 'A1', $ownerUser->id);
    $otherApartment = createPermissionApartment($building, 'B1', $otherOwnerUser->id);

    $residentUser = User::factory()->create(['role' => 'resident']);
    $otherResidentUser = User::factory()->create(['role' => 'resident']);

    $resident = createPermissionResident($residentUser, $building, $ownerApartment);
    $otherResident = createPermissionResident($otherResidentUser, $building, $otherApartment);

    $ownTicket = Ticket::create([
        'title' => 'Owner ticket',
        'description' => 'Description',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $resident->id,
        'building_id' => $building->id,
        'apartment_id' => $ownerApartment->id,
    ]);

    $otherTicket = Ticket::create([
        'title' => 'Other owner ticket',
        'description' => 'Description',
        'statut' => 'ouvert',
        'priorite' => 'moyenne',
        'resident_id' => $otherResident->id,
        'building_id' => $building->id,
        'apartment_id' => $otherApartment->id,
    ]);

    $this->actingAs($ownerUser);

    expect(TicketResource::canEdit($ownTicket))->toBeTrue();
    expect(TicketResource::canEdit($otherTicket))->toBeFalse();
});
