<?php

use App\Models\Gestion\Contractor;
use App\Models\Gestion\Invitation;
use App\Models\Gestion\Resident;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('resident registration creates user and resident record from invitation', function () {
    $invitation = Invitation::create([
        'code' => 'RESIDENT01',
        'role' => 'resident',
    ]);

    session([
        'invitation' => [
            'role' => 'resident',
            'id' => $invitation->id,
        ],
    ]);

    $response = $this->post(route('register.store'), [
        'name' => 'Kate Dupont',
        'email' => 'resident@example.com',
        'password' => 'Password123',
        'password_confirmation' => 'Password123',
    ]);

    $response->assertStatus(409);
    $response->assertHeader('X-Inertia-Location', url('/admin'));

    $user = User::where('email', 'resident@example.com')->first();

    expect($user)->not->toBeNull();
    expect($user->role)->toBe('resident');

    $resident = Resident::where('user_id', $user->id)->first();

    expect($resident)->not->toBeNull();
    expect($resident->prenom)->toBe('Kate');
    expect($resident->nom)->toBe('Dupont');
    expect(Invitation::find($invitation->id))->toBeNull();
});

test('contractor registration creates user and contractor record from invitation', function () {
    $invitation = Invitation::create([
        'code' => 'CONTRACT01',
        'role' => 'contractor',
    ]);

    session([
        'invitation' => [
            'role' => 'contractor',
            'id' => $invitation->id,
        ],
    ]);

    $response = $this->post(route('register.store'), [
        'name' => 'Paul Martin',
        'email' => 'contractor@example.com',
        'password' => 'Password123',
        'password_confirmation' => 'Password123',
    ]);

    $response->assertStatus(409);
    $response->assertHeader('X-Inertia-Location', url('/admin'));

    $user = User::where('email', 'contractor@example.com')->first();

    expect($user)->not->toBeNull();
    expect($user->role)->toBe('contractor');

    $contractor = Contractor::where('user_id', $user->id)->first();

    expect($contractor)->not->toBeNull();
    expect($contractor->prenom)->toBe('Paul');
    expect($contractor->nom)->toBe('Martin');
    expect(Invitation::find($invitation->id))->toBeNull();
});

test('registration is blocked when invitation is missing from session', function () {
    $response = $this->from(route('register'))->post(route('register.store'), [
        'name' => 'Kate Dupont',
        'email' => 'resident@example.com',
        'password' => 'Password123',
        'password_confirmation' => 'Password123',
    ]);

    $response->assertRedirect(route('EnterCode'));
    $response->assertSessionHasErrors('error');
    expect(User::where('email', 'resident@example.com')->exists())->toBeFalse();
});

test('registration is blocked when invitation was already used', function () {
    $usedInvitation = Invitation::create([
        'code' => 'USEDCODE1',
        'role' => 'resident',
        'used_at' => now(),
    ]);

    session([
        'invitation' => [
            'role' => 'resident',
            'id' => $usedInvitation->id,
        ],
    ]);

    $response = $this->from(route('register'))->post(route('register.store'), [
        'name' => 'Kate Dupont',
        'email' => 'used@example.com',
        'password' => 'Password123',
        'password_confirmation' => 'Password123',
    ]);

    $response->assertRedirect(route('EnterCode'));
    $response->assertSessionHasErrors('error');
    expect(User::where('email', 'used@example.com')->exists())->toBeFalse();
});
