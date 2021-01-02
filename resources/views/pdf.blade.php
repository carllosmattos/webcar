<!DOCTYPE html>
<html lang="en">

<head>
  <style type="text/css">
    @page {
      margin: 150px 50px 80px 50px;
    }

    #head {
      background-image: url("fad.jpg");
      background-repeat: no-repeat;
      font-size: 25px;
      text-align: center;
      height: 110px;
      width: 100%;
      position: fixed;
      top: -100px;
      left: 0;
      right: 0;
      margin: auto;
      border: solid 1px #000;
    }

    .logo {
      width: 50%;
      display: inline-block;
      margin-right: 50px;
      font-size: 3vw;
      text-align: center;
      padding: 5vw 0vw 5vw 0vw;
      padding-left: 50px;
    }

    .imgLogo {
      width: 200px;
      height: 65px;
      margin: 15px;
    }

    .number {
      text-align: right;
      display: inline-block;
      margin-right: 0vw;
      font-size: 3vw;
      text-align: right;
      padding: 5vw 0vw 5vw 0vw;
      vertical-align: middle;
      margin-left: -30px;
    }

    .corpo {
      position: relative;
      margin: auto;
    }

    .solicitante {
      width: 695px;
      background-color: aqua;
    }

    .h1 {
      width: 695px;
    }

    .col-12 {
      width: 695px;
    }

    .col-10 {
      width: 580px;
      float: left;
    }

    .col-06 {
      width: 348px;
      float: left;
    }

    .col-03 {
      width: 174px;
      float: left;
    }

    .col-02 {
      width: 116px;
      float: left;
    }

    table,
    th,
    td {
      border: 1px solid gray;
      padding: 2px;
      text-align: center;
    }

    .w {
      font-weight: bold;
    }

    #footer {
      position: fixed;
      bottom: -100px;
      left: -60px;
      width: 102%;
      height: 100px;
      text-align: right;
      border-top: 1px solid gray;
      background-image: url("{{public_path ('images/rodape.png')}}");
      background-repeat: no-repeat;
      background-position: center;
      background-size: contain;
    }

    #footer .page:after {
      content: counter(page);
      margin-right: 40px;
    }
  </style>

  @foreach ($solicitacao as $solicitacao)
  <div id="head">
    <div class="logo">
      <img class="imgLogo" src="{{public_path ('images/logo.png')}}" />
      <img class="imgLogo" src="{{public_path ('images/logo3.png')}}" />
    </div>
    <div class="number">

      Nº: {{$solicitacao->id}} <br>
      <small>Status: <br> {{$solicitacao->statussolicitacao}}</small>

    </div>
  </div>

  <style>
    div.a {
      text-align: center;
    }
  </style>
  <div class="a">
    <h2>SISTEMA DE GESTÃO DE FROTA</h2>
  </div>
  <div class="corpo">

<body>

  <table>
    <thead>
      <th style="width: 682px;">SOLICITAÇÃO DE VEÍCULOS OFICIAIS</th>
    </thead>
  </table>

  <table>
    <tbody>
      <tr>
        <th style="width: 586px;">Setor Solicitantre</th>
        <th style="width: 88px;">Ramal</th>
      </tr>
      <tr>
        @inject('sectors', '\App\Sector')
        @foreach($sectors->getSectors() as $sector)
          @if($solicitacao->namesolicitante === $sector->cc)
            <td>{{$solicitacao->namesolicitante}} - {{$sector->sector}}</td>
          @endif
        @endforeach
        <td>{{$solicitacao->nameramal}}</td>
      </tr>
    </tbody>
  </table>

  <table>
    <tbody>
      <tr>
        <th style="width: 337px;">Roteiro</th>
        <th style="width: 337px;">Finalidade</th>
      </tr>
      <tr>
        <td rowspan="4">{{$solicitacao->origem}} - {{$solicitacao->destino}}</td>
        <td rowspan="4">{{$solicitacao->namefinalidade}}</td>
      </tr>
    </tbody>
  </table>

  <table>
    <thead>
      <th style="width: 682px;">Previsão de Utilização</th>
    </thead>
  </table>

  <table>
    <tbody>
      <tr>
        <th style="width: 337px;" colspan="2">Saída</th>
        <th style="width: 337px;" colspan="2">Retorno</th>
      </tr>
      <tr>
        <td>Data</td>
        <td>Hora</td>
        <td>Data</td>
        <td>Hora</td>
      </tr>
      <tr>
        <td>{{date('d-m-Y', strtotime($solicitacao->datasaida))}}</td>
        <td>{{date('H:i', strtotime($solicitacao->horasaida))}}</td>
        <td>{{date('d-m-Y', strtotime($solicitacao->dataretorno))}}</td>
        <td>{{date('H:i', strtotime($solicitacao->horaretorno))}}</td>
      </tr>
    </tbody>
  </table>

  <table>
    <tbody>
      <tr>
        <th style="width: 682px;">Nome dos Usuários</th>
      </tr>
      <tr>
        <td rowspan="2">{{$solicitacao->nameusuario}}</td>
      </tr>
    </tbody>
  </table>

  <!-- -----------  -->
  <br>
  @if((($solicitacao->statussolicitacao) != 'PENDENTE') && (($solicitacao->statussolicitacao) != 'NÃO REALIZADA'))
  <div id="autorizado">
    <table>
      <thead>
        <th style="width: 682px;">SOLICITAÇÃO DE VEÍCULOS OFICIAIS</th>
      </thead>
    </table>

    <table>
      <tbody>
        <tr>
          <th style="width: 337px;">Veículo</th>
          <th style="width: 337px;">Motorista</th>
        </tr>
        <tr>
          @inject('vehicles', '\App\Vehicle')
          @foreach($vehicles->getVehicles() as $vehicle)
          @if($solicitacao->veiculo == $vehicle->id)
          <td>{{$vehicle->brand}} | {{$vehicle->model}} | {{$vehicle->placa}}</td>
          @endif
          @endforeach
          <td>{{$solicitacao->name_driver}}</td>
        </tr>
      </tbody>
    </table>

    <table>
      <tbody>
        <tr>
          <th style="width: 505px;" colspan="4">Utilização do Veículo</th>
          <th style="width: 169px;" colspan="2">Km's Rodados:
            <?php

            if (($solicitacao->kmfinal == 0) || ($solicitacao->kmfinal == null)) {
              $kmtotal = ' ';
              echo $kmtotal;
            } else {
              $kmtotal = $solicitacao->kmfinal - $solicitacao->kminicial;
              echo $kmtotal;
            }
            ?>

          </th>
        </tr>
        <tr>
          <td>Data <br>Saída</td>
          <td>Hora <br>Saída</td>
          <td>Data <br>Retorno</td>
          <td>Hora <br>Retorno</td>
          <td>Km <br>Inicial</td>
          <td>Km <br>Final</td>
        </tr>
        <tr>
          <td>{{date('d-m-Y', strtotime($solicitacao->datasaidaautorizada))}}</td>
          <td>{{date('H:i', strtotime($solicitacao->horasaidaautorizada))}}</td>
          <td>{{date('d-m-Y', strtotime($solicitacao->dataretornoautorizada))}}</td>
          <td>{{date('H:i', strtotime($solicitacao->horaretornoautorizada))}}</td>
          <!-- Implementar lógica de Quilometragem -->
          <td>{{$solicitacao->kminicial}}</td>
          <td>{{$solicitacao->kmfinal}}</td>
        </tr>
      </tbody>
    </table>


    <table>
      <thead>
        <th style="width: 682px;">ÁREA LOGÍSTA DOS TRANSPORTES</th>
      </thead>
    </table>
    <table>
      <tbody>
        <tr>
          <th style="width: 209px;">Autorizado por</th>
          <th style="width: 100px;">Data</th>
          <th style="width: 249px;">Assinatura do Motorista</th>
          <th style="width: 100px;">Data</th>
        </tr>
        <tr>
          <td>{{$solicitacao->autorizacao}}</td>
          <td>{{date('d-m-Y', strtotime($solicitacao->data))}}</td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table>
      <tbody>
        <tr>
          <th style="width: 682px;">Observação</th>
        </tr>
        <tr>
          <td rowspan="8">{{$solicitacao->observ}}</td>
        </tr>
      </tbody>
    </table>
  </div>
  @endif

  <div id="footer">
  </div>

</body>
@endforeach

</html>