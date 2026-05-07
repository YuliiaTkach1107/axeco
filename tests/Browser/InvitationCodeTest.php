<?php

use Laravel\Dusk\Browser;

test('user can not continue with an invalid invitation code', function () {
    $this->browse(function (Browser $browser) {
        $browser->driver->manage()->deleteAllCookies();

        $browser->visit('/enter-code')
            ->assertSee('Code d’invitation')
            ->type('#code', 'INVALID123')
            ->press('Continuer')
            ->pause(1000)
            ->assertPathIs('/enter-code')
            ->screenshot('invalid-code-error')
            ->storeSource('invalid-code-error')
            ->assertSee('Code invalide');
    });
});
