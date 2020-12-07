<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use \App\authorizacao;

class Authorizacao extends Model
{
  protected $table = "solicitacoes";
  protected $fillable = ['namesolicitante'];


  public function getAuthorizacao($field)
  {
    if (!is_null($field['statussolicitacao'])) {
      $authorizacao = Solicitacao::where('statussolicitacao', 'LIKE', '%' . $field['statussolicitacao'] . '%')
        ->orderBy('id', 'DESC')->get();
    } elseif (!is_null($field['namesolicitante'])) {
      $authorizacao = Solicitacao::where('namesolicitante', 'LIKE', '%' . $field['namesolicitante'] . '%')
        ->orderBy('id', 'DESC')->get();
    }

    return $authorizacao;
  }


  public function getAuthorizacoes()
  {
    $authorizacoes = Authorizacao::all();
    return $authorizacoes;
  }

  public function addAuthorizacao($field)
  {
    $authorizacao = new Authorizacao();

    $authorizacao->namesolicitante = $field['namesolicitante'];
    $authorizacao->nameramal = $field['nameramal'];
    $authorizacao->nameroteiro = $field['nameroteiro'];
    $authorizacao->namefinalidade = $field['namefinalidade'];
    $authorizacao->datahorasaida = $field['datahorasaida'];
    $authorizacao->datahoraretorno = $field['datahoraretorno'];
    $authorizacao->nameusuario = $field['nameusuario'];

    $authorizacao->name_driver = $field['name_driver'];
    $authorizacao->veiculo = $field['veiculo'];
    $authorizacao->datahorasaidaautorizada = $field['datahorasaidaautorizada'];
    $authorizacao->datahoraretornoautorizada = $field['datahoraretornoautorizada'];
    // $authorizacao->kminicial= $field['kminicial'];
    $authorizacao->kmfinal= $field['kmfinal'];
    // $authorizacao->autorizacao = $field['autorizacao'];
    $authorizacao->data = $field['data'];
    $authorizacao->statussolicitacao = $field['statussolicitacao'];

    $authorizacao->save();

  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

}
