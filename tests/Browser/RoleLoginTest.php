<?php

use App\Models\User;
use Laravel\Dusk\Browser;

test('admin can log in to filament', function () {
    $user = User::factory()->create([
        'name' => 'Admin Test',
        'email' => 'admin+'.uniqid().'@example.com',
        'password' => bcrypt('Password123'),
        'role' => 'admin',
    ]);

    $this->browse(function (Browser $browser) use ($user) {
        $browser->driver->manage()->deleteAllCookies();

        $browser->visit('/admin/login')
            ->waitFor('#form\\.email')
            ->type('#form\\.email', $user->email)
            ->type('#form\\.password', 'Password123')
            ->press('Se connecter')
            ->waitForLocation('/admin')
            ->screenshot('admin-login-success')
            ->assertPathBeginsWith('/admin')
            ->assertSee('Tableau de bord');
    });
});

test('resident can log in to filament', function () {
    $user = User::factory()->create([
        'name' => 'Resident Test',
        'email' => 'resident+'.uniqid().'@example.com',
        'password' => bcrypt('Password123'),
        'role' => 'resident',
    ]);

    $this->browse(function (Browser $browser) use ($user) {
        $browser->driver->manage()->deleteAllCookies();

        $browser->visit('/admin/login')
            ->waitFor('#form\\.email')
            ->type('#form\\.email', $user->email)
            ->type('#form\\.password', 'Password123')
            ->press('Se connecter')
            ->waitForLocation('/admin')
            ->screenshot('resident-login-success')
            ->assertPathBeginsWith('/admin')
            ->assertSee('Tableau de bord');
    });
});

test('proprietaire can log in to filament', function () {
    $user = User::factory()->create([
        'name' => 'Proprietaire Test',
        'email' => 'proprietaire+'.uniqid().'@example.com',
        'password' => bcrypt('Password123'),
        'role' => 'proprietaire',
    ]);

    $this->browse(function (Browser $browser) use ($user) {
        $browser->driver->manage()->deleteAllCookies();

        $browser->visit('/admin/login')
            ->waitFor('#form\\.email')
            ->type('#form\\.email', $user->email)
            ->type('#form\\.password', 'Password123')
            ->press('Se connecter')
            ->waitForLocation('/admin')
            ->screenshot('proprietaire-login-success')
            ->assertPathBeginsWith('/admin')
            ->assertSee('Tableau de bord');
    });
});

test('contractor can log in to filament', function () {
    $user = User::factory()->create([
        'name' => 'Contractor Test',
        'email' => 'contractor+'.uniqid().'@example.com',
        'password' => bcrypt('Password123'),
        'role' => 'contractor',
    ]);

    $this->browse(function (Browser $browser) use ($user) {
        $browser->driver->manage()->deleteAllCookies();

        $browser->visit('/admin/login')
            ->waitFor('#form\\.email')
            ->type('#form\\.email', $user->email)
            ->type('#form\\.password', 'Password123')
            ->press('Se connecter')
            ->waitForLocation('/admin')
            ->screenshot('contractor-login-success')
            ->assertPathBeginsWith('/admin')
            ->assertSee('Tableau de bord');
    });
});
