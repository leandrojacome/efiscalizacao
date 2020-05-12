<?php

use Illuminate\Support\Facades\Auth;
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

Route::resource('cidade', 'CidadeController')->middleware('auth','role:super-admin|gerencia|administrativo');
Route::resource('rota', 'RotaController')->middleware('auth','role:super-admin|gerencia|administrativo');
Route::resource('origem', 'OrigemController')->middleware('auth','role:super-admin|gerencia|administrativo');
Route::resource('ocorrencia', 'OcorrenciaController')->middleware('auth','role:super-admin|gerencia|administrativo');
Route::resource('localizacao', 'LocalizacaoController')->middleware('auth','role:super-admin|gerencia|administrativo');
Route::resource('situacao', 'SituacaoController')->middleware('auth','role:super-admin|gerencia|administrativo');
Route::resource('diligencia', 'DiligenciaController')->middleware('auth','role:super-admin|gerencia|administrativo');
Route::resource('tipo_historico', 'TipoHistoricoController')->middleware('auth','role:super-admin|gerencia|administrativo');
Route::resource('tipo_documento', 'TipoDocumentoController')->middleware('auth','role:super-admin|gerencia|administrativo');
Route::resource('permissao', 'PermissaoController')->middleware('auth','role:super-admin');
Route::resource('papel', 'PapelController')->middleware('auth')->middleware('auth','role:super-admin');
Route::resource('fiscal', 'FiscalController')->middleware('auth')->middleware('auth','role:super-admin|gerencia|administrativo');
Route::resource('usuario', 'UsuarioController')->middleware('auth')->middleware('auth','role:super-admin|gerencia');
Route::resource('viagem', 'ViagemController')->middleware('auth')->middleware('auth','role:super-admin|gerencia');
Route::get('/usuario/{id}/password', 'UsuarioController@editPassword')->name('usuario.change.password')->middleware('auth');
Route::get('/usuario/{id}/reset', 'UsuarioController@resetPassword')->name('usuario.reset.password')->middleware('auth');
Route::patch('/usuario/update/{id}/password', 'UsuarioController@updatePassword')->name('usuario.update.password');//->middleware('auth');
Route::get('/diligencia/pdf/{id}', 'DiligenciaController@pdf')->name('pdf')->middleware('auth');
Route::get('/diligencia/historico/{diligencia_id}', 'DiligenciaController@historico')->name('diligencia.historico')->middleware('auth');
Route::post('/diligencia/historico/store/{diligencia_id}', 'DiligenciaController@historicoStore')->name('diligencia.historico.store')->middleware('auth');
Route::get('/getRota/{id?}', 'CidadeController@getRota')->middleware('auth');
Route::get('/foto/upload/{diligencia_id}', 'FotoController@index')->name('foto.upload')->middleware('auth');
Route::post('/foto/upload/{diligencia_id}', 'FotoController@upload')->name('foto.upload.send')->middleware('auth');
Route::get('/foto/delete/{foto_id}', 'FotoController@destroy')->name('foto.delete')->middleware('auth');
Route::delete('/foto/delete/{foto_id}', 'FotoController@destroy')->name('foto.delete')->middleware('auth');
Route::get('/escala/escalaAlternada', 'RotaController@escalaAlternada')->name('rota.escalaAlternada')->middleware('auth');
Route::get('/escala/escalaRotativa', 'RotaController@escalaRotativa')->name('rota.escalaRotativa')->middleware('auth');
Route::get('/escala/escalaEdit', 'RotaController@escalaEdit')->name('rota.escalaEdit')->middleware('auth');
Route::patch('/escala/store', 'RotaController@escalaStore')->name('rota.escalaStore')->middleware('auth');
Route::get('/escala/showEscala', 'RotaController@showEscala')->name('rota.showEscala')->middleware('auth');
Route::get('/escala/pdf/{mes}', 'RotaController@printPDF')->name('rota.escala.pdf')->middleware('auth');
Route::post('/cidade/buscar', 'CidadeController@buscar')->name('cidade.buscar')->middleware('auth','role:super-admin|gerencia|administrativo');
Route::post('/diligencia/buscar', 'DiligenciaController@buscar')->name('diligencia.buscar')->middleware('auth');
Route::post('/rota/buscar', 'RotaController@buscar')->name('rota.buscar')->middleware('auth');
Route::post('/situacao/buscar', 'SituacaoController@buscar')->name('situacao.buscar')->middleware('auth');
Route::post('/fical/buscar', 'FiscalController@buscar')->name('ficalia.buscar')->middleware('auth');
Route::post('/localizacao/buscar', 'LocalizacaoController@buscar')->name('localizacao.buscar')->middleware('auth');
Route::post('/ocorrencia/buscar', 'OcorrenciaController@buscar')->name('ocorrencia.buscar')->middleware('auth');
Route::post('/papel/buscar', 'PapelController@buscar')->name('papel.buscar')->middleware('auth');
Route::post('/permissao/buscar', 'PermissaoController@buscar')->name('permissao.buscar')->middleware('auth');
Route::post('/origem/buscar', 'OrigemController@buscar')->name('origem.buscar')->middleware('auth');
Route::post('/tipo_documento/buscar', 'TipoDocumentoController@buscar')->name('tipo_documento.buscar')->middleware('auth');
Route::post('/tipo_historico/buscar', 'TipoHitorico@buscar')->name('tipo_historico.buscar')->middleware('auth');
Route::post('/usuario/buscar', 'DiligenciaController@buscar')->name('usuario.buscar')->middleware('auth');
Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('auth', 'role:super-admin');
Route::get('/401', function (){
    return view('errors.401');
})->name('401');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');