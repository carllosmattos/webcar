@extends('layouts.application')

@section('content')
<h1 class="ls-title-intro ls-ico-code">Solicitar Veiculo</h1>
<div class="ls-box">

  <h5 class="ls-title-5">Solicitação de uso de veiculos oficiais:</h5>
  <hr>

  <form method="POST" action="{{ route('solicitacao.postAdd') }}" class="ls-form row" id="add">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

    <fieldset>
      <!-- Solicitação de uso de veiculos oficiais: -->
      <div class="col-md-12">
        <div class="form-group col-md-3">
          <label class="ls-label col-md-12 @error('namesolicitante') ls-error @enderror">
            <b class="ls-label-text">Setor Solicitante</b>
            <div class="ls-custom-select">
              <select name="namesolicitante" class="ls-select form-control">
                @inject('sectors', '\App\Sector')
                @foreach($sectors->getSectors() as $sectors)
                <option value="{{$sectors->cc}}" class=" form-control">{{$sectors->cc}} - {{$sectors->sector}}</option>
                @endforeach
              </select>
            </div>
          </label>

        </div>

        <div class="form-group col-md-3">
          <label class="ls-label col-md-12 @error('nameramal') ls-error @enderror">
            <b class="ls-label-text">Ramal</b>
            <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="nameramal" value="{{old('nameramal')}}" maxlength="5" autocomplete="off">

            @error('nameramal')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>

      </div>

      <div class="col-md-12">
        <div class="form-group col-md-3">
          <label class="ls-label col-md-12 @error('nameroteiro') ls-error @enderror">
            <b class="ls-label-text">Origem</b>
            <input type="text" class="form-control" name="nameroteiro[]" value="{{old('nameroteiro')}}">

            @error('nameroteiro')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>

        <div class="form-group col-md-3">
          <label class="ls-label col-md-12 @error('nameroteiro') ls-error @enderror">
            <b class="ls-label-text">Destino</b>
            <input type="text" class="form-control" name="nameroteiro[]" value="{{old('nameroteiro')}}">

            @error('nameroteiro')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>

        <div class="form-group col-md-3">
          <label class="ls-label col-md-12 @error('namefinalidade') ls-error @enderror">
            <b class="ls-label-text">Finalidade</b>
            <input type="text" class="form-control" name="namefinalidade" value="{{old('namefinalidade')}}">

            @error('namefinalidade')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
          <br>
        </div>

      </div>
      <!-- Solicitação de uso de veiculos oficiais: -->

      <!-- Previsão de Utilização do Veiculo -->
      <h5 style="margin-left: 20px;" class="ls-title-5">Previsão de utilização</h5>
      <hr>
      <div class="col-md-12">
        <div class="form-group col-md-3">
          <label class="ls-label col-md-12 @error('datahorasaida') ls-error @enderror">
            <b class="ls-label-text">Data e hora da saída</b>
            <input type="datetime-local" class="form-control ls-mask-date_time" name="datahorasaida" value="{{old('datahorasaida')}}" min="{{date('Y-m-d')}}T{{date('H:i', strtotime('-3 hour', strtotime(date('H:i'))))}}">
            @error('datahorasaida')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>

        <div class="form-group col-md-3">
          <label class="ls-label col-md-12 @error('datahoraretorno') ls-error @enderror">
            <b class="ls-label-text">Data e hora do retorno</b>
            <input type="datetime-local" class="form-control" name="datahoraretorno" value="{{old('datahoraretorno')}}">

            @error('datahoraretorno')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>
      </div>
      <!-- Previsão de Utilização do Veiculo -->

      <!-- Nome dos Pacientes -->
      <h5 style="margin-left: 20px;" class="ls-title-6">Nome dos usuários</h5>
      <div class="col-md-12">
        <div class="form-group col-md-6">
          <label class="ls-label col-md-12 @error('nameusuario') ls-error @enderror">
            <input type="text" class="form-control" name="nameusuario" placeholder="Separe o nome dos usuários com ponto e virgula ( ; )" value="{{old('nameusuario')}}">

            @error('nameusuario')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>
      </div>
      <!-- Nome dos Pacientes -->

    </fieldset>
    <div class="ls-actions-btn">
      <input type="submit" value="Solicitar" class="ls-btn-primary" title="Solicitar" style="font-weight: bold;">
      <input class="ls-btn-primary-danger" type="reset" value="Limpar" style="font-weight: bold;">
    </div>
  </form>
</div>

@stop