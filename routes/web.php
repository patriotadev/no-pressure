<?php

use App\Http\Controllers\PinController;
use App\Models\Pin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'pins' => Pin::all()->map(function ($pin) {
            return [
                'title' => $pin->title,
                'description' => $pin->description,
                'user_name' => $pin->User->name
            ];
        })
    ]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/pins', function () {
        return Inertia::render('Pins', [
            'pins' => Pin::where('user_id', Auth::user()->id)->get()->map(function ($pin) {
                return [
                    'id' => $pin->id,
                    'title' => $pin->title,
                    'description' => $pin->description,
                    'user_name' => $pin->User->name
                ];
            })
        ]);
    })->name('pins');

    Route::get('/pins/create', function () {
        return Inertia::render('Pins/Create');
    })->name('pins_create');

    Route::get('/pins/edit/{id}', [PinController::class, 'edit'])->name('pin_edit');
    Route::post('/pins/create', [PinController::class, 'create'])->name('pin.create');
    Route::post('/pins/store', [PinController::class, 'store'])->name('pin.create');
    Route::post('/pins/update', [PinController::class, 'update'])->name('pin.update');
    Route::post('/pins/destroy', [PinController::class, 'destroy'])->name('pin.destroy');
});
