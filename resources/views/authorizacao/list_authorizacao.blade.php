@extends('layouts.application')

@section('content')
<h1 class="ls-title-intro ls-ico-checkmark-circle">Autorizar solicitações </h1>
<div class="table-responsive">
  <div class="ls-box">

    <div class="box-header">
      <h5 class="ls-title">Listar Autorização</h5>
      <form method="post" action="{{ route('authorizacao.list') }}" class="form form-inline col-md-6" style="margin-bottom: 10px;">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <fieldset>
          <label class="ls-label col-md-12">
            <div class="col-md-4">
              <input type="text" name="namesolicitante" placeholder="Código do setor">
            </div>
            <div class="col-md-1">ou</div>
            <div class="col-md-4">
              <input type="text" name="statussolicitacao" placeholder="Status">
            </div>
            <div class="col-col-md-3">
              <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
          </label>
        </fieldset>
      </form>
      <label class=" col-md-6" style="text-align: right;">Clique em <i class="ls-ico-windows"></i> para visualizar as informações de autorização</label>
    </div>

    <table class="ls-table ls-table-striped ls-bg-header">

      <thead>
        <tr>
          <th>Setor</th>
          <th>Roteiro</th>
          <th>Finalidade</th>
          <th>Saída</th>
          <th>Retorno</th>
          <th>Nome dos Usuários</th>
          <th>Motorista | Veículo</th>
          <th>Status</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
  </div>
  @foreach ($authorizacoes as $authorizacao)
  <tr>
    @inject('sectors', '\App\Sector')
    @foreach($sectors->getSectors() as $sectors)
    @if($sectors->cc === $authorizacao->namesolicitante)
    <td>{{ $sectors->cc }} - {{ $sectors->sector }}</td>
    @else
    @endif
    @endforeach
    <td>{{ $authorizacao->origem }} - {{ $authorizacao->destino }}</td>
    <td>{{ $authorizacao->namefinalidade }}</td>
    <td>Data: {{date('d-m-Y', strtotime($authorizacao->datasaida))}} </br>Hora: {{date('H:i', strtotime($authorizacao->horasaida))}}</td>
    <td>Data: {{date('d-m-Y', strtotime($authorizacao->dataretorno))}} </br>Hora: {{date('H:i', strtotime($authorizacao->horaretorno))}}</td>
    <td>{{ $authorizacao->nameusuario }}</td>

    <td> 
    @if($authorizacao->name_driver == " ")
      Não atribuído
    @else
      {{ $authorizacao->name_driver}}
    @endif
    </br> 
    @if($authorizacao->veiculo == 2)
      Não atribuído
    @else
      @inject('vehicles', '\App\Vehicle')
      @foreach($vehicles->getVehicles() as $vehicle)
        @if($vehicle->id == $authorizacao->veiculo)
          {{ $vehicle->brand }} {{$vehicle->model}} - {{$vehicle->placa}}
        @endif
      @endforeach
    @endif
    </td>

    @if($authorizacao->statussolicitacao == "PENDENTE")
    <td><label class="ls-ico-history" style="color: red;"> {{ $authorizacao->statussolicitacao }}</label></td>
    @elseif($authorizacao->statussolicitacao == "AUTORIZADA")
    <td><label class="ls-ico-thumbs-up" style="color: green;"> {{ $authorizacao->statussolicitacao }}</label></td>
    @elseif($authorizacao->statussolicitacao == "REALIZADA")
    <td><label class="ls-ico-checkmark" style="color: Mediumaquamarine;"> {{ $authorizacao->statussolicitacao }}</label></td>
    @else
    <td><label class="ls-ico-bukets" style="color: blue;"> {{ $authorizacao->statussolicitacao }}</label></td>
    @endif
    <td>
      <div class="col-md-12">
        <div class="col-md-4">
          @if($authorizacao->statussolicitacao == "AUTORIZADA" || $authorizacao->statussolicitacao == "PENDENTE")
          <a class="ls-ico-pencil ls-btn-dark" style="background-color: blue;" href="{{ route('authorizacao.edit', $authorizacao->id) }}"></a>
          @else
          @endif
        </div>
        <div class="col-md-4">
          @if($authorizacao->statussolicitacao == "PENDENTE")
          <a class="ls-ico-remove ls-btn-primary-danger" href="{{ route('authorizacao.delete', $authorizacao->id) }}"></a>
          @else
          @endif
        </div>
        <div class="col-md-4">
          <a class="ls-ico-windows ls-btn" href="{{ route('updf', $authorizacao->id) }}"></a>
        </div>
      </div>

    </td>
  </tr>
  @endforeach
  </tbody>
  </table>
</div>

@stop