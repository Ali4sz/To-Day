<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

/*
|--------------------------------------------------------------------------
| Landing page regression coverage
|--------------------------------------------------------------------------
|
| Structural assertions for the rebuilt landing page: auth-aware navigation,
| stable section anchors, truthful static preview, removal of the legacy
| metrics/charts content, and the guest vs authenticated CTA split.
|
| Randomized client-side behavior (the hero star field) is intentionally NOT
| asserted here beyond its stable decorative hooks; it is covered by browser
| verification instead.
|
*/

uses(RefreshDatabase::class);

it('renders the landing page for guests', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('exposes concise anchor navigation and stable section targets for guests', function () {
    $response = $this->get('/');
    $html = $response->getContent();

    // Anchor links in the landing navigation.
    $response->assertSee('href="#benefits"', false);
    $response->assertSee('href="#preview"', false);
    $response->assertSee('href="#how-it-works"', false);
    $response->assertSee('href="#about"', false);

    // Exactly one section exists for each anchor target.
    expect(substr_count($html, 'id="benefits"'))->toBe(1);
    expect(substr_count($html, 'id="preview"'))->toBe(1);
    expect(substr_count($html, 'id="how-it-works"'))->toBe(1);
    expect(substr_count($html, 'id="about"'))->toBe(1);

    // Landing navigation uses dedicated classes, never the task page's
    // .navbar-nav .nav-link selectors that the task SPA intercepts.
    expect($html)->not->toContain('navbar-nav');
    expect($html)->not->toContain('class="nav-link');
    expect($html)->not->toContain('data-section');
    expect($html)->toContain('landing-nav-link');
});

it('points guest conversion actions at signup and login', function () {
    $response = $this->get('/');

    // Hero CTA and navigation/final CTAs target the signup route.
    $response->assertSee("Let's Get Started", false);
    $response->assertSee('href="' . route('signupgo') . '"', false);

    // Login remains reachable from the navigation and the final CTA.
    $response->assertSee('Log In');
    $response->assertSee('href="' . route('logingo') . '"', false);
});

it('keeps the preserved hero copy and decorative hooks', function () {
    $response = $this->get('/');
    $html = $response->getContent();

    $response->assertSee('Conquer Your Day,');
    $response->assertSee('Focus, organize, and achieve with to-day, your personal task manager.');

    // Decorative layer hooks remain present exactly once each.
    expect(substr_count($html, 'hero-star-field'))->toBe(1);
    expect(substr_count($html, 'hero-mountain-scene'))->toBe(1);

    // Exactly one h1 keeps the heading hierarchy clean.
    expect(substr_count($html, '<h1'))->toBe(1);
});

it('renders the rebuilt narrative sections', function () {
    $response = $this->get('/');

    // Value transition, benefits, workflow, purpose, and final CTA copy.
    $response->assertSee('Turn scattered to-dos into one clear view');
    $response->assertSee('Capture Without Friction');
    $response->assertSee('Focus on Today');
    $response->assertSee('Finish With Clarity');
    $response->assertSee('Capture it');
    $response->assertSee('Shape your day');
    $response->assertSee('Finish and clear');
    $response->assertSee('Built for calm, steady');
    $response->assertSee('Ready to meet your day?');

    // Footer keeps the product statement and a server-rendered year.
    $response->assertSee('A simple personal task manager');
    expect($response->getContent())->toContain('id="currentYear"');
});

it('shows a clearly labelled, non-interactive product preview', function () {
    $response = $this->get('/');
    $html = $response->getContent();

    // The preview is explicitly presented as an example.
    $response->assertSee('Example preview');
    $response->assertSee('Sample tasks shown for illustration', false);

    // Only supported task concepts appear in the mock.
    $response->assertSee("Today's Focus", false);
    $response->assertSee('high priority');
    $response->assertSee('medium priority');
    $response->assertSee('No due date');

    // The mock itself contains no interactive elements: it must not expose
    // buttons, links, or form controls that could be mistaken for live UI.
    $mockStart = strpos($html, 'landing-preview-mock');
    $mockEnd = strpos($html, 'landing-preview-caption');
    expect($mockStart)->not->toBeFalse();
    expect($mockEnd)->not->toBeFalse();
    $mock = substr($html, $mockStart, $mockEnd - $mockStart);
    expect($mock)->not->toContain('<button');
    expect($mock)->not->toContain('<a ');
    expect($mock)->not->toContain('<input');
    expect($mock)->not->toContain('<form');
});

it('contains no legacy metrics, charts, or unsupported claims', function () {
    $response = $this->get('/');
    $html = $response->getContent();

    // Old metric/chart markup and illustrative-data disclaimers are gone.
    expect($html)->not->toContain('metric-value');
    expect($html)->not->toContain('metric-label');
    expect($html)->not->toContain('chart-card');
    expect($html)->not->toContain('bar-chart');
    expect($html)->not->toContain('Illustrative data');
    expect($html)->not->toContain('Happy Users');
    expect($html)->not->toContain('Tasks Completed');
    expect($html)->not->toContain('Satisfaction Rate');
    expect($html)->not->toContain('Monthly Active Users');

    // Old long-form About blocks are gone.
    expect($html)->not->toContain('Our Motto');
    expect($html)->not->toContain('Our Goals');
    expect($html)->not->toContain('Our Aspirations');
    expect($html)->not->toContain('about-block');

    // No unsupported product claims leak into the page.
    expect($html)->not->toContain('reminder');
    expect($html)->not->toContain('notification');
    expect($html)->not->toContain('calendar sync');
    expect($html)->not->toContain('recurring');
    expect($html)->not->toContain('collaboration');
    expect($html)->not->toContain('analytics');
});

it('renders task destinations instead of guest conversion actions when authenticated', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/');

    $response->assertStatus(200);

    // The primary account action now opens the tasks.
    $response->assertSee('Open My Tasks');
    $response->assertSee('href="' . route('index') . '"', false);

    // Guest-only conversion actions are no longer offered.
    $html = $response->getContent();
    expect($html)->not->toContain('href="' . route('signupgo') . '"');
    expect($html)->not->toContain('href="' . route('logingo') . '"');
    expect($html)->not->toContain("Let's Get Started");
    expect($html)->not->toContain('Get Started');
    expect($html)->not->toContain('Log In');
});
