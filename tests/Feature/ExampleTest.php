<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('renders the stargazing hero with preserved copy and decorative hooks', function () {
    $response = $this->get('/');

    $response->assertStatus(200);

    // Preserved hero copy (heading, subtitle, and CTA label are unchanged).
    $response->assertSee('Conquer Your Day,');
    $response->assertSee('Focus, organize, and achieve with to-day, your personal task manager.');
    $response->assertSee("Let's Get Started", false);

    // The CTA still points at the signup route.
    $response->assertSee('href="' . route('signupgo') . '"', false);

    // The decorative layer hooks are present exactly once each. These are
    // stable structural assertions; the randomized stars themselves are
    // generated client-side and are covered by browser verification instead.
    $html = $response->getContent();
    expect(substr_count($html, 'hero-star-field'))->toBe(1);
    expect(substr_count($html, 'hero-mountain-scene'))->toBe(1);
    expect(substr_count($html, 'hero-ridge--far'))->toBe(1);
    expect(substr_count($html, 'hero-ridge--middle'))->toBe(1);
    expect(substr_count($html, 'hero-ridge--foreground'))->toBe(1);
});
