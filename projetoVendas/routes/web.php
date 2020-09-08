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
    return view('welcome');
});

Route::get('vendas', function(){
    return view('view_vendas');
});

Route::get('enviar-email', function(){
    $user = new stdClass;
    $user->name = 'Marcios Silva';
    $user->email = 'seuemail@yteste.com';

    // descomentar esta linha comentar a linha de enviar email abaixo para teste
    // return new App\Mail\SendMailRelatorio($user);

    // enviar email
    Illuminate\Support\Facades\Mail::send(new App\Mail\SendMailRelatorio($user));
    
});

// Route::get('teste','testController@getQuery');