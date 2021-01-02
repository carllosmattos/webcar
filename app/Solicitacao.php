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
    $solicitacao->origem = $field['origem'];
    $solicitacao->destino = $field['destino'];
    $solicitacao->namefinalidade = $field['namefinalidade'];
    $solicitacao->datasaida = $field['datasaida'];
    $solicitacao->horasaida = $field['horasaida'];
    $solicitacao->dataretorno = $field['dataretorno'];
    $solicitacao->horaretorno = $field['horaretorno'];
    $solicitacao->nameusuario = $field['nameusuario'];

    $solicitacao->name_driver = 'SEM MOTORISTA';
    $solicitacao->veiculo = 2;
    $solicitacao->kminicial = null;
    $solicitacao->kmfinal = null;
    $solicitacao->autorizacao = ' ';
    $solicitacao->data = null;
    $solicitacao->statussolicitacao = 'PENDENTE';

    $solicitacao->save();
  }
}
