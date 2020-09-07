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
    $user->name = 'marcios silva';
    $user->email = 'oportunidade.marcio@gmail.com';
    // return new App\Mail\SendMailRelatorio($user);
    Illuminate\Support\Facades\Mail::send(new App\Mail\SendMailRelatorio($user));
    // Mail::send('mail.envio_email',['relatorio'=>'tudo certo'],function($m){
    //     $m->from('marciossilva@papoartificial.com.br');
    //     $m->subject('Meu email de teste');
    //     $m->to('marciosunico18@gmail.com');
    // });
});

Route::get('teste','testController@getQuery');