@extends('layouts.application')

@section('content')
<h1 class="ls-title-intro ls-ico-dashboard">Listar Veiculos</h1>
<div class="ls-box">
  <div class="box-header">
    <h5 class="ls-title">Listar Veiculo</h5>

    <form method="post" action="{{ route('vehicle.list') }}" class="form form-inline">
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      <fieldset>
        <label class="ls-label col-md-12">
          <div class="col-md-10">
            <input type="text" name="situacao" placeholder="Situação">
          </div>
          <div class="col-col-md-3">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
          </div>
        </label>
      </fieldset>
    </form>
  </div>

  <table class="ls-table ls-table-striped ls-bg-header">
    <thead>
      <tr>
        <th>Motorista</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Placa</th>
        <th>Ano</th>
        <th>Quilometragem atual(Km)</th>
        <th>Situação do veiculo</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($vehicles as $vehicle)
        @if($vehicle->id == 2)
        @else
          <tr>
            @foreach($drivers as $driver)
              @if($vehicle->driver_id == $driver->id)
                <td>{{$driver->name_driver}}</td>
              @endif
            @endforeach
            <td>{{ $vehicle->brand }}</td>
            <td>{{ $vehicle->model }}</td>
            <td>{{ $vehicle->placa }}</td>
            <td>{{ $vehicle->year}}</td>
            <td>{{ $vehicle->km}}</td>
            @if($vehicle->situacao == "LIVRE")
            <td><label class="ls-ico-thumbs-up" style="color: green;"> {{ $vehicle->situacao }}</label></td>
            @elseif($vehicle->situacao == "EM USO")
            <td><label class="ls-ico-hours" style="color: blue;"> {{ $vehicle->situacao }}</label></td>
            @else
            <td><label class="ls-ico-cog" style="color: red;"> {{ $vehicle->situacao }}</label></td>
            @endif
            <td>
              @if($vehicle->brand == "Gerador")
              @else
              <div class="col-md-4">
                <a class="ls-ico-pencil ls-btn-dark" style="background-color: blue;" href="{{ route('vehicle.edit', $vehicle->id) }}"></a>
              </div>
              <div class="col-md-4">
                <a class="ls-ico-remove ls-btn-primary-danger" href="{{ route('vehicle.delete', $vehicle->id) }}"></a>
              </div>
              @endif
              <div class="col-md-4">
                <a class="ls-ico-stats ls-btn-primary" href="{{ route('expense.add', $vehicle->id) }}"></a>
              </div>
            </td>
          </tr>
        @endif
      @endforeach
    </tbody>
  </table>

</div>
@stop