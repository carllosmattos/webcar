<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use \App\authorizacao;

class Authorizacao extends Model
{
  protected $table = "solicitacoes";
  protected $fillable = ['namesolicitante', ];

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
    $authorizacao->kmfinal= $field['kmfinal'];
    $authorizacao->data = $field['data'];
    $authorizacao->statussolicitacao = $field['statussolicitacao'];

    $authorizacao->save();

  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

}
