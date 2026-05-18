<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('contact form stores a message', function () {
    $response = $this->post('/contact', [
        'name' => 'Dika',
        'email' => 'dika@example.com',
        'subject' => 'Halo',
        'message' => 'Saya ingin diskusi project.',
    ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('contact_messages', [
        'email' => 'dika@example.com',
        'subject' => 'Halo',
    ]);
});

test('project detail shows final project report content', function () {
    $project = Project::create([
        'title' => 'Website Portfolio Personal Dinamis',
        'slug' => 'website-portfolio-personal-dinamis',
        'description' => 'Portfolio dan laporan awal project akhir.',
        'technologies' => ['Laravel', 'Filament'],
        'status' => 'Progress',
        'progress' => 65,
        'problem_analysis' => 'Portfolio statis sulit diperbarui.',
        'system_requirements' => ['CRUD project', 'Form kontak dinamis'],
        'architecture' => 'MVC Laravel dengan MySQL dan Filament.',
        'diagram_steps' => ['Buka portfolio', 'Pilih project', 'Kirim pesan'],
        'is_active' => true,
    ]);

    $this->get(route('projects.show', $project))
        ->assertOk()
        ->assertSee('Laporan Awal Project Akhir')
        ->assertSee('Portfolio statis sulit diperbarui.')
        ->assertSee('CRUD project')
        ->assertSee('MVC Laravel dengan MySQL dan Filament.');
});
