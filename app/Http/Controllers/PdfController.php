<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Solicitacao;
use \App\Authorizacao;
use PDF;

class PdfController extends Controller
{
    public function gerarPdf( $id){

      $solicitacao = Solicitacao::where('id', '>', 0)->where('id', 'like', $id)->get();

      $pdf = PDF::loadView('pdf', compact('solicitacao',  $solicitacao));
      return $pdf->setPaper('a4')->stream('Solicitação.pdf');
    }

       public function gerarPdf1( $id)
    {
       $authorizacao = Authorizacao::where('id', '>', 0)->where('id', 'like', $id)->get();

      $updf = PDF::loadView('updf', compact('authorizacao'));
      return $updf->setPaper('a4')->stream('Autorização.pdf');

    }

}
