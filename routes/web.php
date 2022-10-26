<?php

use App\Http\Livewire\AdminPage;
use App\Http\Livewire\EditPage;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Frontpage;
use App\Http\Livewire\Homepage;
use App\Http\Livewire\PageList;
use App\Http\Livewire\TagList;

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

            Route::get('/admin', AdminPage::class)->name('admin');

            Route::get('/admin/pages', function () {
                return view('admin.pages');
            })->name('edit-pages')->middleware(['permission:edit pages']);

            Route::get('/admin/pages/new', function () {
                return view('livewire.edit-page', ['is_new' => true]);
            })->name('edit-page')->middleware(['permission:edit pages']);

            Route::get('/pages/{urlslug}/edit', EditPage::class)->middleware(['permission:edit pages'])->name('edit-page');

            Route::get('/admin/users', function () {
                return view('admin.users');
            })->name('edit-users')->middleware(['permission:edit users']);

            Route::get('/admin/users/{id}', function () {
                return view('livewire.user.edit-user');
            })->name('edit-users')->middleware(['permission:edit users']);

            Route::get('/admin/permissions', function () {
                return view('admin.permissions');
            })->name('edit-permissions');

            Route::get('/admin/roles', function () {
                return view('admin.roles');
            })->name('edit-roles');

            Route::get('/admin/tags', function () {
                return view('admin.tags');
            })->name('edit-tags')->middleware(['permission:edit tags']);
        });
        Route::get('/pages', PageList::class)->name('page-list');
        Route::get('/pages/{urlslug}', Frontpage::class)->name('page.show');
        Route::get('/tags/{tag}', TagList::class)->name('tags');
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


