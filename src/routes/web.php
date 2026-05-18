<?php

use App\Models\ContactMessage;
use App\Models\Project;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Livewire\Livewire;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
Route::get('/', function () {
    $projects = Project::active()
        ->where('slug', '!=', 'website-portfolio-personal-dinamis')
        ->orderBy('sort_order')
        ->orderByDesc('created_at')
        ->get();

    return view('welcome', compact('projects'));
});

Route::get('/laporan-uts', function () {
    return view('reports.uts');
})
    ->withoutMiddleware([StartSession::class, ShareErrorsFromSession::class, VerifyCsrfToken::class])
    ->name('reports.uts');

Route::get('/laporan-uts/pdf', function () {
    $path = public_path('files/laporan-uts.pdf');

    abort_unless(file_exists($path), 404);

    return response()->file($path, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="Laporan UTS Portfolio.pdf"',
    ]);
})
    ->withoutMiddleware([StartSession::class, ShareErrorsFromSession::class, VerifyCsrfToken::class])
    ->name('reports.uts.pdf');

Route::get('/projects/{project:slug}', function (Project $project) {
    abort_unless($project->is_active, 404);

    return view('projects.show', compact('project'));
})->name('projects.show');

Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'subject' => ['nullable', 'string', 'max:255'],
        'message' => ['required', 'string', 'max:2000'],
    ]);

    ContactMessage::create($data);

    return back()
        ->with('contact_success', 'Pesan berhasil dikirim. Terima kasih sudah menghubungi saya.');
})->name('contact.store');
