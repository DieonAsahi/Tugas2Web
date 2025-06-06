<?php

use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests are redirected to the login page', function () {
    // Simulate guest user
    $response = $this->get(route('dashboard'));
    
    // Assert that the guest is redirected to the login page
    $response->assertRedirect(route('login')); 
});


test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response->assertStatus(200);
});