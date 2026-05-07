<?php

use App\Models\Gestion\Apartment;
use App\Models\Gestion\Building;
use App\Models\Gestion\Resident;
use App\Models\Gestion\Ticket;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;

test('resident can create a ticket through the interface', function () {
    $email = 'resident-ticket+'.Str::lower(Str::random(6)).'@example.com';
    $title = 'Fuite cuisine '.Str::upper(Str::random(4));

    $residentUser = User::factory()->create([
        'name' => 'Resident Ticket Test',
        'email' => $email,
        'password' => bcrypt('Password123'),
        'role' => 'resident',
    ]);

    $building = Building::create([
        'nom' => 'Residence Dusk',
        'adresse' => '1 Rue de Dusk',
        'ville' => 'Bruxelles',
        'code_postal' => '1000',
        'nombre_logements' => 10,
    ]);

    $apartment = Apartment::create([
        'numero' => 'A1',
        'copropriete_id' => $building->id,
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

    $this->browse(function (Browser $browser) use ($residentUser, $building, $apartment, $resident, $title) {
        $browser->driver->manage()->deleteAllCookies();

        $browser->visit('/admin/login')
            ->waitFor('#form\\.email')
            ->type('#form\\.email', $residentUser->email)
            ->type('#form\\.password', 'Password123')
            ->press('Se connecter')
            ->waitForLocation('/admin')
            ->visit('/admin/gestion/tickets/create')
            ->pause(1500)
            ->script("
                const form = document.querySelector('form[wire\\\\:submit=\"create\"], form[wire\\\\:submit\\\\.prevent=\"create\"]');
                if (! form) {
                    throw new Error('No create form found on ticket create page.');
                }

                const host = form.closest('[wire\\\\:id]');
                if (! host) {
                    throw new Error('No Livewire host found for the ticket create form.');
                }

                const component = window.Livewire.find(host.getAttribute('wire:id'));
                component.set('data.title', '".addslashes($title)."');
                component.set('data.description', 'Il y a une fuite dans la cuisine.');
                component.set('data.priorite', 'moyenne');
                component.set('data.building_id', {$building->id});
                component.set('data.apartment_id', {$apartment->id});
                component.set('data.resident_id', {$resident->id});
                component.call('create');
            ");

        $browser->pause(2000)
            ->assertPathBeginsWith('/admin/gestion/tickets')
            ->assertSee($title)
            ->screenshot('resident-ticket-created');
    });

    expect(Ticket::where('title', $title)->exists())->toBeTrue();
});
