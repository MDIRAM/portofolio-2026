<?php

use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\Report;
use App\Models\SiteContent;
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
    $content = SiteContent::valuesForPage('welcome');

    return view('welcome', compact('content', 'projects'));
});

Route::get('/laporan-uts', function () {
    return redirect()->route('reports.show');
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

Route::get('/laporan', function () {
    $report = Report::where('slug', 'panduangame')
        ->where('is_published', true)
        ->firstOrFail();
    $content = SiteContent::valuesForPage('reports.show');

    return view('reports.show', compact('content', 'report'));
})
    ->withoutMiddleware([StartSession::class, ShareErrorsFromSession::class, VerifyCsrfToken::class])
    ->name('reports.show');

Route::get('/laporan/pdf', function () {
    $path = public_path('files/laporan-uts.pdf');

    abort_unless(file_exists($path), 404);

    return response()->file($path, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="Laporan Lengkap PanduanGame.pdf"',
    ]);
})
    ->withoutMiddleware([StartSession::class, ShareErrorsFromSession::class, VerifyCsrfToken::class])
    ->name('reports.full-pdf');

Route::get('/projects/{project:slug}', function (Project $project) {
    abort_unless($project->is_active, 404);
    $content = SiteContent::valuesForPage('projects.show');

    return view('projects.show', compact('content', 'project'));
})->name('projects.show');

Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'subject' => ['nullable', 'string', 'max:255'],
        'message' => ['required', 'string', 'max:2000'],
    ]);

    ContactMessage::create($data);
    $content = SiteContent::valuesForPage('welcome');

    return back()
        ->with('contact_success', $content['contact_labels']['success']);
})->name('contact.store');
