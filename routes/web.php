<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('login');
});

Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
    $beers = app(App\Http\Requests\PunkAPIClient::class)->list($request->query());
    $page = $request->query('page') ?? 1;
    $per_page = $request->query('per_page') ?? 25;
    $noMoreBeer = false;
    if (!count($beers)) {
        $noMoreBeer = true;
    }
    return view('dashboard', compact('beers', 'page', 'per_page', 'noMoreBeer'));
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
