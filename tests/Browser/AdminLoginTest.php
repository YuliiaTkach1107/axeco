<?php

use App\Models\User;
use Laravel\Dusk\Browser;

test('admin can log in to filament', function () {
    $user = User::factory()->create([
        'email' => 'admin8@test.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    $this->browse(function (Browser $browser) use ($user) {
        $browser->visit('/admin/login')
            ->waitFor('#form\\.email')
            ->type('#form\\.email', $user->email)
            ->type('#form\\.password', 'password')
            ->press('Se connecter')
            ->assertPathBeginsWith('/admin');
    });
});
