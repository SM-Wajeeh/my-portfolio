<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
// ── Portfolio front page ──────────────────────────────────────────
Route::get('/', function () {
    $skills   = \App\Models\Skill::orderBy('sort_order')->get();
    $projects = \App\Models\Project::orderBy('sort_order')->get();
    return view('main', compact('skills', 'projects'));
})->name('home');

// ── Admin panel (protect with auth middleware in production) ──────
Route::prefix('admin1572wAjeeh')->name('admin.')->group(function () {

    Route::get('/', fn() => redirect()->route('admin.skills.index'));

    Route::resource('skills',   SkillController::class)
         ->except(['show']);

    Route::resource('projects', ProjectController::class)
         ->except(['show']);
});

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');