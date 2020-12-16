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

  @foreach ($authorizacao as $authorizacao)
  <div id="head">
    <div class="logo">
      <img class="imgLogo" src="{{public_path ('images/logo.png')}}" />
      <img class="imgLogo" src="{{public_path ('images/logo3.png')}}" />
    </div>
    <div class="number">

      Nº: {{$authorizacao->id}} <br>
      <small>Status: <br> {{$authorizacao->statussolicitacao}}</small>
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
          @if($authorizacao->namesolicitante === $sector->cc)
            <td>{{$authorizacao->namesolicitante}} - {{$sector->sector}}</td>
          @endif
        @endforeach
        <td>{{$authorizacao->nameramal}}</td>
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
        <td rowspan="4">{{$authorizacao->nameroteiro}}</td>
        <td rowspan="4">{{$authorizacao->namefinalidade}}</td>
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
        <td>{{date('yy-m-d', strtotime($authorizacao->datahorasaida))}}</td>
        <td>{{date('H:i', strtotime($authorizacao->datahorasaida))}}</td>
        <td>{{date('yy-m-d', strtotime($authorizacao->datahoraretorno))}}</td>
        <td>{{date('H:i', strtotime($authorizacao->datahoraretorno))}}</td>
      </tr>
    </tbody>
  </table>

  <table>
    <tbody>
      <tr>
        <th style="width: 682px;">Nome dos Usuários</th>
      </tr>
      <tr>
        <td rowspan="2">{{$authorizacao->nameusuario}}</td>
      </tr>
    </tbody>
  </table>

  <!-- -----------  -->
  @if((($authorizacao->statussolicitacao) != 'PENDENTE') && (($authorizacao->statussolicitacao) != 'NÃO REALIZADA'))
  <br>
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
        @if($authorizacao->veiculo == $vehicle->id)
        <td>{{$vehicle->brand}} | {{$vehicle->model}} | {{$vehicle->placa}}</td>
        @endif
        @endforeach
        <td>{{$authorizacao->name_driver}}</td>
      </tr>
    </tbody>
  </table>

  <table>
    <tbody>
      <tr>
        <th style="width: 505px;" colspan="4">Utilização do Veículo</th>
        <th style="width: 169px;" colspan="2">Km's Rodados:
          <?php

          if (($authorizacao->kmfinal == 0) || ($authorizacao->kmfinal == null)) {
            $kmtotal = ' ';
            echo $kmtotal;
          } else {
            $kmtotal = $authorizacao->kmfinal - $authorizacao->kminicial;
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
        <td>{{date('yy-m-d', strtotime($authorizacao->datahorasaidaautorizada))}}</td>
        <td>{{date('H:i', strtotime($authorizacao->datahorasaidaautorizada))}}</td>
        <td>{{date('yy-m-d', strtotime($authorizacao->datahoraretornoautorizada))}}</td>
        <td>{{date('H:i', strtotime($authorizacao->datahoraretornoautorizada))}}</td>
        <!-- Implementar lógica de Quilometragem -->
        <td>{{$authorizacao->kminicial}}</td>
        <td>{{$authorizacao->kmfinal}}</td>
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
        <td>{{$authorizacao->autorizacao}}</td>
        <td>{{$authorizacao->data}}</td>
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
        <td rowspan="8">{{$authorizacao->observ}}</td>
      </tr>
    </tbody>
  </table>
  @endif

  <div id="footer">
  </div>

</body>
@endforeach

</html>