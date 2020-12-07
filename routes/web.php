<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Tester\TesterTrait;

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

Auth::routes();
Route::get('/pdf/{id}', 'PdfController@gerarPdf')->name('pdf');
Route::get('/updf/{id}', 'PdfController@gerarPdf1')->name('updf');
Route::get('/informacao/add', 'InformacaoController@get_add_informacao')->name('informacao.add'); // Rota da view

// ROTAS PARA DESLOGAR E ENVIAR PARA VIEW DE LOGIN
Route::get('/logout', 'Auth\LoginController@logout');

// ROTAS PARA A CONTROLLER HOME - METODO INDEX
Route::group(['middleware' => ['auth', 'noRolesAssigned']], function () {
    Route::get('/', 'HomeController@index')->name('home');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/accessdenied', 'AccessdeniedController@index')->name('accessdenied.add');

Route::group(['middleware' => ['auth', 'userRequest']], function () {
    //================================== ROTAS PARA Solicitação ==================================//
    // ROTAS PARA ADICIONAR Solicitação
    Route::get('/solicitacao/add', 'SolicitacaoController@get_add_solicitacao')->name('solicitacao.add'); // Rota da view
    Route::post('/solicitacao/add', 'SolicitacaoController@post_add_solicitacao')->name('solicitacao.postAdd'); // Rota do formulário

    // ROTAS PARA LISTAR Solicitação
    Route::get('/solicitacao', function () {
        return redirect()->route('solicitacoes');
    });
    Route::post('/solicitacao', 'SolicitacaoController@post_list_solicitacao')->name('solicitacao.list');
    Route::get('/solicitacoes', 'SolicitacaoController@list_solicitacoes')->name('solicitacoes');

    //ROTAS PARA EDITAR Solicitação
    Route::get('/solicitacao/edit/{id}', 'SolicitacaoController@get_edit_solicitacao')->name('solicitacao.edit');
    Route::post('/solicitacao/edit/{id}', 'SolicitacaoController@post_edit_solicitacao')->name('solicitacao.postEdit');
    Route::get('/solicitacao/delete/{id}', 'SolicitacaoController@delete_solicitacao')->name('solicitacao.delete');
});

//================================== Middleware acesso somente para ADM e SUPER ADM ==================================//
Route::group(['middleware' => ['auth', 'superAdm']], function () {
    //================================== ROTAS PARA USUÁRIO ==================================//
    // ROTAS PARA LISTAR USUÁRIO
    Route::get('/users', function () {
        return redirect()->route('users');
    });
    Route::get('/users', 'UpdateUserController@list_users')->name('users');
    
    // ROTAS PARA EDITAR USUÁRIO
    Route::get('/user/edit/{id}', 'UpdateUserController@get_edit_user')->name('user.edit');
    Route::post('/user/edit/{id}', 'UpdateUserController@post_edit_user')->name('user.postEdit');
    // ROTAS PARA DELETAR VEICULO
    Route::get('/user/delete/{id}', 'UpdateUserController@delete_user')->name('user.delete');
    
    //================================== ROTAS PARA VEÍCULO ==================================//
    // ROTAS PARA ADICIONAR VEICULO

    Route::get('/vehicle/add', 'VehicleController@get_add_vehicle')->name('vehicle.add'); // Rota da view
    Route::post('/vehicle/add', 'VehicleController@post_add_vehicle')->name('vehicle.postAdd'); // Rota do formulário


    // ROTAS PARA LISTAR VEICULO
    Route::get('/vehicle', function () {
        return redirect()->route('vehicles');
    });
    Route::post('/vehicle', 'VehicleController@post_list_vehicle')->name('vehicle.list');
    Route::get('/vehicles', 'VehicleController@list_vehicles')->name('vehicles');

    Route::any('/vehicle-search', 'VehicleController@searchVehicle')->name('vehicle.search');

    // ROTAS PARA EDITAR VEICULO
    Route::get('/vehicle/edit/{id}', 'VehicleController@get_edit_vehicle')->name('vehicle.edit');
    Route::post('/vehicle/edit/{id}', 'VehicleController@post_edit_vehicle')->name('vehicle.postEdit');

    // ROTAS PARA DELETAR VEICULO
    Route::get('/vehicle/delete/{id}', 'VehicleController@delete_vehicle')->name('vehicle.delete');

    // ROTAS PARA LISTAR Autorização
    Route::get('/authorizacao', function () {
        return redirect()->route('authorizacoes');
    });
    Route::post('/authorizacao', 'AuthorizacaoController@post_list_authorizacao')->name('authorizacao.list');
    Route::get('/authorizacoes', 'AuthorizacaoController@list_authorizacoes')->name('authorizacoes');

    //ROTAS PARA EDITAR Autorização
    Route::get('/authorizacao/edit/{id}', 'AuthorizacaoController@get_edit_authorizacao')->name('authorizacao.edit');
    Route::post('/authorizacao/edit/{id}', 'AuthorizacaoController@post_edit_authorizacao')->name('authorizacao.postEdit');

    // ROTAS PARA DELETAR Autorização
    Route::get('/authorizacao/delete/{id}', 'AuthorizacaoController@delete_authorizacao')->name('authorizacao.delete');


    //================================== ROTAS PARA CUSTO ==================================//
    // ROTAS PARA ADICIONAR CUSTO

    Route::get('/expense/addfree', 'ExpenseController@get_add_expense_livre')->name('expense.addfree'); // Custo livre
    Route::get('/expense/add', 'ExpenseController@get_add_expense')->name('expense.add'); // Custo a partir de veículo
    Route::post('/expense/add', 'ExpenseController@post_add_expense')->name('expense.postAdd'); // Rota do formulário


    // ROTAS PARA LISTAR CUSTO
    Route::get('/expense', function () {
        return redirect()->route('expenses');
    });
    Route::post('/expense', 'ExpenseController@post_list_expense')->name('expense.list');
    Route::get('/expenses', 'ExpenseController@list_expenses')->name('expenses');

    // ROTAS PARA EDITAR CUSTO
    Route::get('/expense/edit/{id}', 'ExpenseController@get_edit_expense')->name('expense.edit');
    Route::post('/expense/edit/{id}', 'ExpenseController@post_edit_expense')->name('expense.postEdit');

    // ROTAS PARA DELETAR CUSTO
    Route::get('/expense/delete/{id}', 'ExpenseController@delete_expense')->name('expense.delete');


    //================================== ROTAS PARA CUSTO ==================================//
    // ROTAS PARA ADICIONAR CUSTO

    Route::get('/roleuser/add', 'RoleUserController@get_add_role_user')->name('roleuser.add');
    Route::post('/roleuser/add', 'RoleUserController@post_add_role_user')->name('roleuser.postAdd');

    // ROTAS PARA LISTAR PAPEL
    Route::get('/roleuser', function () {
        return redirect()->route('roleusers');
    });
    Route::post('/roleuser', 'RoleUserController@post_list_role_user')->name('roleuser.list');
    Route::get('/roleusers', 'RoleUserController@list_role_users')->name('roleusers');

    // ROTAS PARA EDITAR PAPEL
    Route::get('/roleuser/edit/{id}', 'RoleUserController@get_edit_role_use')->name('roleuser.edit');
    Route::post('/roleuser/edit/{id}', 'RoleUserController@post_edit_role_use')->name('roleuser.postEdit');

    // ROTAS PARA DELETAR PAPEL
    Route::get('/roleuser/delete/{id}', 'RoleUserController@delete_role')->name('roleuser.delete');

    //================================== ROTAS PARA MOTORISTA ==================================//
    // ROTAS PARA ADICIONAR MOTORISTA

    Route::get('/driver/add', 'DriverController@get_add_driver')->name('driver.add'); // Rota da view
    Route::post('/driver/add', 'DriverController@post_add_driver')->name('driver.postAdd'); // Rota do formulário


    // ROTAS PARA LISTAR MOTORISTA
    Route::get('/driver', function () {
        return redirect()->route('drivers');
    });
    Route::post('/driver', 'DriverController@post_list_driver')->name('driver.list');
    Route::get('/drivers', 'DriverController@list_drivers')->name('drivers');

    Route::any('/driver-search', 'DriverController@searchdriver')->name('driver.search');

    // ROTAS PARA EDITAR MOTORISTA
    Route::get('/driver/edit/{id}', 'DriverController@get_edit_driver')->name('driver.edit');
    Route::post('/driver/edit/{id}', 'DriverController@post_edit_driver')->name('driver.postEdit');

    // ROTAS PARA DELETAR MOTORISTA
    Route::get('/driver/delete/{id}', 'DriverController@delete_driver')->name('driver.delete');


    //================================== ROTAS PARA Gráficos e relatórios ==================================//
    // ROTAS PARA CUSTOS POR VEÍCULO
    Route::resource('vehicle-cost', 'ChartController');

    Route::get('/vehicle-cost', function () {
        return redirect()->route('vehicle-cost');
    });
    Route::post('/vehicle-cost', 'ChartController@searchVeicleIntervalDate')->name('vehicle-cost');
    Route::get('/vehicle-cost', 'ChartController@costByVehicle')->name('vehicle-cost');

    // ROTAS PARA CUSTOS POR SETOR
    Route::resource('sector-cost', 'ChartController');

    Route::get('/sector-cost', function () {
        return redirect()->route('sector-cost');
    });
    Route::post('/sector-cost', 'ChartController@searchSectorIntervalDate')->name('sector-cost');
    Route::get('/sector-cost', 'ChartController@costBySector')->name('sector-cost');

});
