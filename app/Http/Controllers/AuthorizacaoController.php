<?php

namespace App\Http\Controllers;

use DB;
use \App\Authorizacao;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorizeRequest;
use Illuminate\Support\Facades\Auth;

class AuthorizacaoController extends Controller
{
  private $authorizacao;

  public function __construct(Authorizacao $authorizacao)
  {
    $this->authorizacoes = $authorizacao;
    $this->authorizacao = $authorizacao;

    $this->middleware('auth');
  }
  //-------------------- Adicionar Autorização--------------------//
  public function get_add_authorizacao(Request $field)
  {
    return view('authorizacao/add_authorizacao');
  }

  public function post_add_authorizacao(AuthorizeRequest $info)
  {

    $authorizacao = $this->authorizacao->addAuthorizacao($info);
    return redirect()->route('authorizacoes')->with('message', 'Autorização adicionada com sucesso!');;
  }
  //------------------------------------------------------------//
  //---------------- Listar Autorização Específico -----------------//
  public function get_list_authorizacao()
  {
  }

  public function post_list_authorizacao(Request $field)
  {
    if (!is_null($field['statussolicitacao']) || !is_null($field['namesolicitante'])) {
      $authorizacoes = $this->authorizacao->getauthorizacao($field);
    } else {
      $authorizacoes = $this->authorizacoes->getAuthorizacoes();
    }
    return view('authorizacao/list_authorizacao', compact('authorizacoes'));
  }
  //------------------------------------------------------------//

  //--------------------- Listar Autorização----------------------//
  public function list_authorizacoes()
  {
    $authorizacoes = $this->authorizacoes->get()->sortByDesc("id");
    return view('authorizacao/list_authorizacao', compact('authorizacoes'));
  }
  //------------------------------------------------------------//

  //-------------------- Editar Autorização --------------------//
  public function get_edit_authorizacao($id)
  {
    $authorizacao = $this->authorizacao->find($id);

    return view('authorizacao/edit_authorizacao', compact('authorizacao'));
  }

  public function post_edit_authorizacao(AuthorizeRequest $info, $id)
  {
    $authorizacao = $this->authorizacao->find($id);

    $authorizacao->name_driver                = $info['name_driver'];
    $authorizacao->veiculo                    = $info['veiculo'];
    
    // Busca o Id do motorista com base no nome selecionado
    $driver = DB::table('drivers')->where('name_driver', $info['name_driver'])->get('id');
    foreach ($driver as $driver) {
    };
    
    // Salva o id do motorista no veículo selecionado, com base no
    // id do veículo selecionado
    DB::table('vehicles')
    ->where('id', $info['veiculo'])
    ->update(
      [
        'driver_id' => $driver->id,
      ]
    );
    $authorizacao->datasaidaautorizada    = $info['datasaidaautorizada'];
    $authorizacao->horasaidaautorizada    = $info['horasaidaautorizada'];
    $authorizacao->dataretornoautorizada  = $info['dataretornoautorizada'];
    $authorizacao->horaretornoautorizada  = $info['horaretornoautorizada'];

    // Pega o carro selecionado e sua Km e registra em Km inicial na tabela solicitacoes
    $kmcar = DB::table('vehicles')->where('id', $info['veiculo'])->get('km');
    foreach ($kmcar as $kmcar) {
    }
    $authorizacao->kminicial                  = $kmcar->km;

    $authorizacao->kmfinal                    = $info['kmfinal'];
    $authorizacao->autorizacao                = Auth::user()->name;
    $authorizacao->data                       = date('Y-m-d');
    $authorizacao->statussolicitacao          = $info['statussolicitacao'];

    // Cria um custo em Km após status REALIZADA
    if ($info['statussolicitacao'] == 'REALIZADA') {

      $amount = (intval($info['kmfinal']) - intval($kmcar->km));
      
      DB::table('expenses')->insert(
        [
          'vehicle_id' => $info['veiculo'],
          'name_expense' => 'Quilometragem',
          'category_id' => 2,
          'unitary_value' => 1,
          'amount' => $amount,
          'discount' => 0,
          'data' => date('Y-m-d'),
	  'hora' => date('H:i:s'),
          'created_at' => now(),
          'updated_at' => now(),
        ]
      );

      // Quando status REALIZADA, altera o Km do veículo selecionado na tabela vehicles
      DB::table('vehicles')->where('id', $info['veiculo'])->update(
        [
          'km' => $info['kmfinal'],
        ]
      );
    }

    if ($info['statussolicitacao'] == 'NÃO REALIZADA') {

      $authorizacao->kmfinal                    = $kmcar->km;
      
      DB::table('vehicles')->where('id', $info['veiculo'])->update(
        [
          'km' => $kmcar->km,
        ]
      );
    }

    $authorizacao->save();
    return redirect()->route('authorizacoes')->with('message', 'Solicitação alterada com sucesso!');
  }
  //-------------------- Deletar Autorização --------------------//

  public function delete_authorizacao($id)
  {
    $authorizacao = $this->authorizacao->find($id);
    $authorizacao->delete();
    return redirect()->route('authorizacoes')->with('message', 'Autorização excluído com sucesso!');
  }

  // Teste
  public function rolesPermissions()
  {
    $nameUser = auth()->user()->name;
    var_dump("<h1>{$nameUser}</h1>");

    foreach (auth()->user()->roles as $role) {
      echo "$role->name -> <br>";

      $permissions = $role->permissions;
      foreach ($permissions as $permission) {
        echo " $permission->name, <br>";
      }
    }
  }
}
