<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \App\Informacao;

class InformacaoController extends Controller
{


  public function get_add_informacao(Request $field)
  {
    return view('informacao/add_informacao');
  }

}
