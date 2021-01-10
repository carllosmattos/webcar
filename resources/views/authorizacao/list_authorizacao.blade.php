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
  @foreach ($aut as $result)
  <tr>
    @inject('sectors', '\App\Sector')
    @foreach($sectors->getSectors() as $sectors)
    @if($sectors->cc === $result->namesolicitante)
    <td>{{ $sectors->cc }} - {{ $sectors->sector }}</td>
    @else
    @endif
    @endforeach
    <td>{{ $result->origem }} - {{ $result->destino }}</td>
    <td>{{ $result->namefinalidade }}</td>
    <td>Data: {{date('d-m-Y', strtotime($result->datasaida))}} </br>Hora: {{date('H:i', strtotime($result->horasaida))}}</td>
    <td>Data: {{date('d-m-Y', strtotime($result->dataretorno))}} </br>Hora: {{date('H:i', strtotime($result->horaretorno))}}</td>
    <td>{{ $result->nameusuario }}</td>

    <td> 
    @if($result->name_driver == " ")
      Não atribuído
    @else
      {{ $result->name_driver}}
    @endif
    </br> 
    @if($result->veiculo == 2)
      Não atribuído
    @else
      @inject('vehicles', '\App\Vehicle')
      @foreach($vehicles->getVehicles() as $vehicle)
        @if($vehicle->id == $result->veiculo)
          {{ $vehicle->brand }} {{$vehicle->model}} - {{$vehicle->placa}}
        @endif
      @endforeach
    @endif
    </td>

    @if($result->statussolicitacao == "PENDENTE")
    <td><label class="ls-ico-history" style="color: red;"> {{ $result->statussolicitacao }}</label></td>
    @elseif($result->statussolicitacao == "AUTORIZADA")
    <td><label class="ls-ico-thumbs-up" style="color: green;"> {{ $result->statussolicitacao }}</label></td>
    @elseif($result->statussolicitacao == "REALIZADA")
    <td><label class="ls-ico-checkmark" style="color: Mediumaquamarine;"> {{ $result->statussolicitacao }}</label></td>
    @else
    <td><label class="ls-ico-bukets" style="color: blue;"> {{ $result->statussolicitacao }}</label></td>
    @endif
    <td>
      <div class="col-md-12">
        <div class="col-md-4">
          @if($result->statussolicitacao == "AUTORIZADA" || $result->statussolicitacao == "PENDENTE")
          <a class="ls-ico-pencil ls-btn-dark" style="background-color: blue;" href="{{ route('authorizacao.edit', $result->id) }}"></a>
          @else
          @endif
        </div>
        <div class="col-md-4">
          @if($result->statussolicitacao == "PENDENTE")
          <a class="ls-ico-remove ls-btn-primary-danger" href="{{ route('authorizacao.delete', $result->id) }}"></a>
          @else
          @endif
        </div>
        <div class="col-md-4">
          <a class="ls-ico-windows ls-btn" href="{{ route('updf', $result->id) }}"></a>
        </div>
      </div>

    </td>
  </tr>
  @endforeach
  </tbody>
  </table>
  {{ $aut->links() }}
</div>


@stop