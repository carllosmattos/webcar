<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

// use \App\solicitacao;

class Solicitacao extends Model
{
  protected $table = "solicitacoes";
  protected $fillable = ['namesolicitante'];

  public function getSolicitacao($field)
  {
    if (!is_null($field['statussolicitacao'])) {
      $solicitacao = Solicitacao::where('user_id', auth()->user()->id)->where('statussolicitacao', 'LIKE', '%' . $field['statussolicitacao'] . '%')
        ->orderBy('id', 'DESC')->get();
    } elseif (!is_null($field['namesolicitante'])) {
      $solicitacao = Solicitacao::where('user_id', auth()->user()->id)->where('namesolicitante', 'LIKE', '%' . $field['namesolicitante'] . '%')
        ->orderBy('id', 'DESC')->get();
    } else {
      $solicitacao = Solicitacao::all();
    }

    return $solicitacao;
  }

  public function getSolicitacoes()
  {
    $solicitacoes = Solicitacao::all();

    return $solicitacoes;
  }

  public function addSolicitacao($field)
  {
    $solicitacao = new Solicitacao();
    $solicitacao->user_id = Auth::user()->id;
    $solicitacao->namesolicitante = $field['namesolicitante'];
    $solicitacao->nameramal = $field['nameramal'];
    $solicitacao->nameroteiro = implode(" - ", $field['nameroteiro']);
    $solicitacao->namefinalidade = $field['namefinalidade'];
    $solicitacao->datahorasaida = $field['datahorasaida'];
    $solicitacao->datahoraretorno = $field['datahoraretorno'];
    $solicitacao->nameusuario = $field['nameusuario'];

    $solicitacao->name_driver = 'SEM MOTORISTA';
    $solicitacao->veiculo = 2;
    $solicitacao->kminicial = null;
    $solicitacao->kmfinal = null;
    $solicitacao->autorizacao = ' ';
    $solicitacao->data = date("Y-m-d");
    $solicitacao->statussolicitacao = 'PENDENTE';

    $solicitacao->save();
  }
}
