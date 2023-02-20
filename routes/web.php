<?php

use App\Role;
use App\Sector;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
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
    return redirect('/login');
});

Auth::routes();
Auth::routes(['register' => false]);

Route::get('/build', function () {
    $recurosHumanos = new Role();
    $recurosHumanos->slug = 'gestor-recursos-humanos';
    $recurosHumanos->name = 'Gestor de Recursos Humanos';
    $recurosHumanos->save();

    $manager_role = new Role();
    $manager_role->slug = 'super-admin';
    $manager_role->name = 'Super Admim';
    $manager_role->save();

    $manager_role = new Role();
    $manager_role->slug = 'usuario-normal';
    $manager_role->name = 'Usuário normal ';
    $manager_role->save();

    $manager_role = new Role();
    $manager_role->slug = 'gestor-administracao';
    $manager_role->name = 'Gestor Administrativo';
    $manager_role->save();

    $manager_role = new Role();
    $manager_role->slug = 'gestor-manutencao';
    $manager_role->name = 'Gestor da área de manutenção ';
    $manager_role->save();

    $motorista_role = new Role();
    $motorista_role->slug = 'motorista';
    $motorista_role->name = 'Motorista';
    $motorista_role->save();

    $recursos_role = Role::where('slug', 'gestor-recursos-humanos')->first();
    $gestor_administracao_role = Role::where('slug', 'gestor-administracao')->first();
    $usuario_normal_role = Role::where('slug', 'usuario-normal')->first();
    $super_admin_role = Role::where('slug', 'super-admin')->first();
    $manutencao_role = Role::where('slug', 'gestor-manutencao')->first();

    $super_usuario = new User();
    $super_usuario->name = 'Super Usuario';
    $super_usuario->email = 'manager@teste.com';
    $super_usuario->username = 'manage.com';
    $super_usuario->password = bcrypt('manager');
    $super_usuario->save();
    $super_usuario->roles()->attach($super_admin_role);

    $sector = new Sector();
    $sector->user_id = $super_usuario->id;
    $sector->name = "Geral";
    $sector->save();
    $super_usuario->sectors()->attach($sector);

    $administracao = new User();
    $administracao->name = 'Administracao';
    $administracao->email = 'administracao@teste.com';
    $administracao->username = 'administracao.com';
    $administracao->password = bcrypt('administracao');
    $administracao->save();
    $administracao->roles()->attach($gestor_administracao_role);

    $usuario_normal = new User();
    $usuario_normal->name = 'Usuario Normal';
    $usuario_normal->email = 'usuario@teste.com';
    $usuario_normal->username = 'usuario.com';
    $usuario_normal->password = Hash::make(123456);
    $usuario_normal->save();
    $usuario_normal->roles()->attach($usuario_normal_role);

    $recursosH = new User();
    $recursosH->name = 'Recursos H';
    $recursosH->email = 'recursosh@teste.com';
    $recursosH->username = 'recursosh.com';
    $recursosH->password = Hash::make(123456);
    $recursosH->save();
    $recursosH->roles()->attach($recursos_role);

    $manutencao = new User();
    $manutencao->name = 'Manutencao';
    $manutencao->email = 'manutencao@teste.com';
    $manutencao->username = 'manutencao.com';
    $manutencao->password = Hash::make(123456);
    $manutencao->save();
    $manutencao->roles()->attach($manutencao_role);

    return User::all();

});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', function () {
        auth()->logout();
        Session()->flush();
        return Redirect::to('/');
    })->name('logout');

    Route::get('/', 'HomeController@index')->name('normal.dashboard');
    Route::resource('avaria', 'AvariaController');
    Route::resource('escala', 'EscalaController');
    Route::resource('remuneracao', 'AumentoRemuneracaoController');
    Route::resource('justificacao', 'JustificaoFaltaController');
    Route::resource('prolongamento', 'ProlongamentoController');
    Route::resource('pedido', 'PedidoController');
    Route::resource('pedidoRescisao', 'PedidoRescisaoController');
    Route::get('avaria/{avaria}/resposta/detalhes', 'AvariaController@showResponse')->name('avaria.resposta-detalhes');
    Route::get('avaria/{avaria}/pdf/', 'AvariaController@exportAvariaPdf')->name('avaria.export');
    Route::resource('requisicaoTransporte', 'RequisicaoTransporteController');
    Route::get('carta/create', 'CartaController@create')->name('carta.create');

    Route::resource('advertencia', 'AdvertenciaController');
    Route::get('advertencia/geraPDF/{advertencia}', 'AdvertenciaController@makePDF')->name('advertencia.PDF');

    Route::put('avaria/{avaria}/responder', 'AvariaController@responderSolicitacao')->name('avaria.response');

    Route::put('avaria/{avaria}/feedback', 'AvariaController@feedback')->name('avaria.feedback');

    Route::put('avaria/{avaria}/estado', 'AvariaController@setEstado')->name('avaria.estado');

    Route::post('/fecth/dependent', 'RequisicaoTransporteController@selectViagem')->name('requisicao.selectViagem');

    Route::get('/substituicao', 'FeriaController@substituicoes')->name('feria.subistacao');

    Route::get('avaria/geraPDF/{avaria}', 'AvariaController@geraPDF')->name('avaria-requisicao.geraPDF');

    Route::get('pre_requisicao/PDF/{pre}', 'RequisicaoTransporteController@exportPreReqPdf')->name('pre-requisicao.PDF');

    Route::resource('preRequest', 'PreRequisicaoController');
    Route::get('preRequest/{pre}/read', 'PreRequisicaoController@read')->name('pre.read');

    Route::get('user/details/{user}', 'UserRegisterController@show')->name('user.details');
    Route::put('password/update', 'UserRegisterController@updatePassword')->name('password.update');

    Route::post('getSector', 'SectorController@getSector')->name('sector.getSector');
    Route::post('getUser', 'UserRegisterController@getUser')->name('user.getUser');
    Route::post('getTecnico', 'TecnicoController@getTecnico')->name('tecnico.getTecnico');
    Route::post('getMotorista', 'MotoristaController@getMotorista')->name('motorista.getMotorista');
    Route::post('getTransporte', 'TransporteController@getTransporte')->name('transporte.getTransporte');
    Route::resource('rescisao', 'RescisaoController');
    Route::resource('feria', 'FeriaController');
    Route::post('carta/store', 'CartaController@store')->name('carta.store');
    Route::get('carta', 'CartaController@index')->name('carta.index');
    Route::get('chefe/parecer/{justificacao}', 'JustificaoFaltaController@parecer')->name('justificacao.parecer.chefe');

});

//Manutencao
Route::group(['middleware' => 'role:gestor-manutencao'], function () {
    Route::resource('tecnico', 'TecnicoController');
    Route::resource('fornecedor', 'FornecedorController');
    Route::post('getFornecedor', 'FornecedorController@getFornecedor');
    Route::get('avaria/{avaria}/descricao', 'AvariaController@showAvariaRequest')->name('avaria.descricao');
    Route::get('avarias/todas', 'AvariaController@todasAvarias')->name('avaria.todas');
    Route::get('avarias/report', 'AvariaController@report')->name('avaria.report');
});

//Manutencao
Route::group(['middleware' => 'role:motorista'], function () {
    Route::resource('tarefa', 'TarefaController');
});

// Administrativo
Route::group(['middleware' => 'role:gestor-administracao'], function () {
    Route::resource('transportes', 'TransporteController');
    Route::resource('local', 'LocalController');
    Route::resource('motorista', 'MotoristaController');
    Route::get('requisicoes', 'RequisicaoTransporteController@allRequests')->name('requisicaoTransporte.all');

    Route::get('requisicoes/report', 'RequisicaoTransporteController@report')->name('requisicoes.report');

    Route::get('requisicao/pdf/{pre}', 'RequisicaoTransporteController@gerarPDF')->name('requisicao.export');
});

//Recursos Humanos
Route::group(['middleware' => 'role:gestor-recursos-humanos'], function () {
    Route::get('cartas/search', 'CartaController@search');
    Route::resource('contrato', 'ContratoController');
    Route::resource('adenda', 'AdendaController');
    Route::get('rechumanos/parecer/{justificacao}', 'JustificaoFaltaController@parecer')->name('justificacao.parecer');
    Route::get('adenda/{adenda}/pdf', 'AdendaController@makePDF')->name('adenda.pdf');
    Route::get('contratos/search', 'ContratoController@search');
    Route::get('contratos/{contrato}/pdf', 'ContratoController@makePDFIndividual')->name('contrato.pdfNormal');
    Route::get('prolongamento/{contrato}/pdf', 'ProlongamentoController@makePDF')->name('prolongamento.pdf');
    Route::get('escala/{escala}/pdf', 'EscalaController@makePDF')->name('escala.pdf');
    Route::get('contrato/create/cps', 'ContratoController@createCps')->name('contrato.createCps');
    Route::get('prolongamentos/all', 'ProlongamentoController@todosProlongamentos')->name('prolongamento.all');
    Route::get('ferias/all', 'FeriaController@todasFerias')->name('feria.all');
    Route::get('justificacoes/all', 'JustificaoFaltaController@todasJustificacoes')->name('justificacao.all');

    Route::get('advertencias/all', 'AdvertenciaController@all')->name('advertencia.all');


    Route::get('escalas/all', 'EscalaController@todasEscalas')->name('escala.all');
    Route::get('remuneracoes/all', 'AumentoRemuneracaoController@todas')->name('remuneracao.all');
    Route::get('contratos/all', 'ContratoController@todos')->name('contrato.all');
    Route::get('pedidosRescisao/all', 'PedidoRescisaoController@todos')->name('pedidoRescisao.all');

    Route::get('contrato/{id}/user', 'ContratoController@contratoPeloUsuario')->name('contrato.user');

    Route::get('escalas/report', 'EscalaController@report')->name('escala.report');
    Route::get('pedidosRescisao/report', 'PedidoRescisaoController@report')->name('pedidoRescisao.report');

    Route::get('prolongamentos/report', 'ProlongamentoController@report')->name('prolongamento.report');

    Route::get('justificacoes/report', 'JustificaoFaltaController@report')->name('prolongamento.report');

    Route::get('remuneracoes/report', 'AumentoRemuneracaoController@report')->name('remuneracoes.report');


});

Route::group(['middleware' => 'super-admin'], function () {

    Route::get('/registar', 'UserRegisterController@registerForm')->name('user.register');
    Route::post('/registar', 'UserRegisterController@create')->name('user.gravar');
    Route::resource('sector', 'SectorController');
    Route::get('/usuarios', 'UserRegisterController@index')->name('user.all');
    Route::get('/usuarios/{user}/edit', 'UserRegisterController@edit')->name('user.edit');
    Route::put('/usuarios/{user}/update', 'UserRegisterController@update')->name('user.actualizar');
    Route::get('/admin/dashboard', 'HomeController@adminDashboard')->name('admin.dashboard');
});
