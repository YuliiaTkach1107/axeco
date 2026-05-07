<?php

use App\Models\Gestion\Invitation;
use App\Models\User;
use Laravel\Dusk\Browser;
use Illuminate\Support\Str;

test('user can register with a valid invitation code', function () {
    $email = 'kate+'.Str::lower(Str::random(6)).'@example.com';
    $code = Str::upper(Str::random(8));

    Invitation::create([
        'code' => $code,
        'role' => 'resident',
    ]);

    $this->browse(function (Browser $browser) use ($code, $email) {
        $browser->visit('/enter-code')
            ->type('#code', $code)
            ->press('Continuer')
            ->waitForLocation('/register')
            ->assertSee('Créer un compte')
            ->type('#name', 'Kate Dupont')
            ->type('#email', $email)
            ->type('#password', 'Password123')
            ->type('#password_confirmation', 'Password123')
            ->press('Créer un compte')
            ->waitForLocation('/admin');
    });

    expect(User::where('email', $email)->exists())->toBeTrue();
});

test('user can not register with a weak password', function () {
    $email = 'check+'.Str::lower(Str::random(6)).'@example.com';
    $code = Str::upper(Str::random(8));

    Invitation::create([
        'code' => $code,
        'role' => 'resident',
    ]);

    $this->browse(function (Browser $browser) use ($code, $email) {
        $browser->driver->manage()->deleteAllCookies();
        $browser->visit('/enter-code')
            ->type('#code', $code)
            ->press('Continuer')
            ->waitForLocation('/register')
            ->assertSee('Créer un compte')
            ->type('#name', 'Kate Dupont')
            ->type('#email', $email)
            ->type('#password', 'password')
            ->type('#password_confirmation', 'password')
            ->press('Créer un compte')
            ->pause(1000)
            ->screenshot('weak-password-error')
            ->storeSource('weak-password-error')
            ->assertSee('mot de passe');
    });
});
