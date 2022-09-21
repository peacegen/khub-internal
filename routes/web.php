<?php

use App\Http\Livewire\EditPage;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Frontpage;
use App\Http\Livewire\Homepage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::middleware(['accessteam'])->group(function ()
    {
        Route::middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified',
            'role:super-admin'
        ])->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');

            // TODO Make better settings routing
            Route::get('/settings', function () {
                return view('livewire.settings');
            })->name('settings');

            Route::get('/admin/pages', function () {
                return view('admin.pages');
            })->name('pages')->middleware(['permission:edit pages']);

            Route::get('/admin/users', function () {
                return view('admin.users');
            })->name('users')->middleware(['permission:edit users']);

            Route::get('/admin/permissions', function () {
                return view('admin.permissions');
            })->name('permissions');

            Route::get('/admin/roles', function () {
                return view('admin.roles');
            })->name('roles');

            Route::get('/admin/tags', function () {
                return view('admin.tags');
            })->name('tags')->middleware(['permission:edit tags']);
        });
        Route::get('/{urlslug}/edit', EditPage::class);
        Route::get('/{urlslug}', Frontpage::class);
    });

    Route::post('attachments', function () {
        request()->validate([
            'attachment' => ['required', 'file'],
        ]);

        $path = request()->file('attachment')->store('attachments', 'public');

        return [
            'image_url' => Storage::disk('public')->url($path),
        ];
    })->middleware(['auth'])->name('attachments.store');

    Route::get('/', Homepage::class);

});


