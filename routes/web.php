<?php

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
            // 'accessrole',
        ])->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');

            // TODO Make better settings routing
            Route::get('/settings', function () {
                return view('livewire.settings');
            })->name('settings');

            Route::get('/settings/pages', function () {
                return view('admin.pages');
            })->name('pages');

            Route::get('/settings/users', function () {
                return view('admin.users');
            })->name('users');

            Route::get('/settings/permissions', function () {
                return view('admin.permissions');
            })->name('permissions');

            Route::get('/settings/roles', function () {
                return view('admin.roles');
            })->name('roles');

            Route::get('/settings/tags', function () {
                return view('admin.tags');
            })->name('tags');
        });

        Route::get('/', Homepage::class);
        Route::get('/{urlslug}', Frontpage::class);

    });

});


