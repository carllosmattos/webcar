@extends('layouts.application')

@section('content')

<h1 class="ls-title-intro ls-ico-user-add">Autorização de saidas</h1>
<div class="ls-box">

  <form method="Post" action="{{ route('authorizacao.postAdd') }}" class="ls-form row">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <fieldset>

      <link rel="stylesheet" href="<?php echo asset('css/collapsibleAuthorize.css') ?>" type="text/css">
      <button id="coll-01" type="button" class="collapsible">
        Solicitação de veículos
        <strong id="icon-collapse-1">
          <i class="ls-ico-circle-up ls-ico-right"></i>
        </strong>
      </button>
      <div id="content-01" style="display: block;">

        <!-- Solicitação de uso de veiculos oficiais: -->
        <div class="col-md-12">
          <h5 class="ls-title-6">Setor</h5>
          <div class="form-group col-md-3">
            <label class="ls-label col-md-12 @error('namesolicitante') ls-error @enderror">
              <b class="ls-label-text">Setor Solicitante</b>
              <input type="text" class="form-control" name="namesolicitante" value="{{old('namesolicitante')}}">

              @error('namesolicitante')
              <div class="ls-help-message">
                {{$message}}
              </div>
              @enderror

            </label>
          </div>

          <div class="form-group col-md-3">
            <label class="ls-label col-md-12 @error('nameramal') ls-error @enderror">
              <b class="ls-label-text">Ramal</b>
              <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="nameramal" value="{{old('nameramal')}}" maxlength="4" autocomplete="off">

              @error('nameramal')
              <div class="ls-help-message">
                {{$message}}
              </div>
              @enderror

            </label>
          </div>

        </div>
        <div class="col-md-12">
          <h5 class="ls-title-6">Roteiro</h5>
          <div class="form-group col-md-3">
            <label class="ls-label col-md-12 @error('nameroteiro') ls-error @enderror">
              <b class="ls-label-text">Destino</b>
              <input type="text" class="form-control" name="nameroteiro" value="{{old('nameroteiro')}}">

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
            <input type="datetime-local" class="form-control" name="datahorasaida" value="{{old('datahorasaida')}}" min="{{date('yy-m-d')}}T{{date('H:i', strtotime('-2 hour', strtotime(date('H:i'))))}}">
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

      </div>
      @if($errors->has('namesolicitante')
      || $errors->has('nameramal')
      || $errors->has('nameroteiro')
      || $errors->has('namefinalidade')
      || $errors->has('datahorasaida')
      || $errors->has('datahoraretorno')
      || $errors->has('nameusuario'))
      <script type="text/javascript">
        var contentUm = document.getElementById("content-01");
        contentDois.style.display = "block";
      </script>
      @endif

      <button id="coll-02" type="button" class="collapsible">
        Autorizar
        <strong id="icon-collapse-2">
          <i class="ls-ico-circle-down ls-ico-right"></i>
        </strong>
      </button>
      <div id="content-02" style="display: none;" class="">
        <div class="col-md-12">
          <h5 class="ls-title-6">Veículo</h5>
          <div class="form-group col-md-3">
            <label class="ls-label col-md-12 @error('namemotorista') ls-error @enderror">
              <b class="ls-label-text">Motorista</b>
              <input type="text" class="form-control" name="namemotorista" value="{{old('namemotorista')}}">

              @error('namemotorista')
              <div class="ls-help-message">
                {{$message}}
              </div>
              @enderror

            </label>
          </div>
          <!-- Injeção de Serviço -->
          <div class="form-group col-md-3">
            <label class="ls-label col-md-12  @error('veiculo') ls-error @enderror">
              <b class="ls-label-text">Veículo</b>
              @inject('vehicles', '\App\Vehicle')
              <div class="ls-custom-select">
                <select name="veiculo" class="ls-select">
                  <option value=""></option>
                  @foreach($vehicles->getVehicles() as $vehicles)
                  <option value="{{ $vehicles->placa }}">{{ $vehicles->brand }} {{ $vehicles->model }} |
                    {{ $vehicles->placa}} | {{ $vehicles->situacao }}</option>
                  @endforeach
                </select>
              </div>

              @error('veiculo')
              <div class="ls-help-message">
                {{$message}}
              </div>
              @enderror

            </label>
          </div>
          <div class="form-group col-md-3">
          </div>
          <div class="form-group col-md-3">
            <label class="ls-label col-md-12 @error('statussolicitacao') ls-error @enderror">
              <script type="text/javascript" src="<?php echo asset('../js/changeinp.js') ?>"></script>
              <b class="ls-label-text">Situação</b>
              <div class="ls-custom-select">
                <select id="sit" name="statussolicitacao" class="ls-select" onchange="verifica(this.value)">
                  <option style="background-color: red; color: #fff; font-weight: bold;" value=""></option>
                  <option style="background-color: red; color: #fff; font-weight: bold;" value="PENDENTE">PENDENTE</option>
                  <option style="background-color: blue; color: #fff; font-weight: bold;" value="EM ANALISE">EM ANALISE</option>
                  <option style="background-color: green; color: #fff; font-weight: bold;" value="AUTORIZADO">AUTORIZADA</option>
                  <option style="background-color: MediumAquamarine; color: #fff; font-weight: bold;" value="REALIZADO">REALIZADA</option>
                </select>
              </div>

              @error('statussolicitacao')
              <div class="ls-help-message">
                {{$message}}
              </div>
              @enderror

            </label>
          </div>
          <!-- Injeção de Serviço -->
        </div>

        <!-- LIBERAÇÃO de Utilização do Veiculo -->
      <div class="col-md-12">
        <div class="form-group col-md-3">
          <label class="ls-label col-md-12 @error('datahorasaidaautorizada') ls-error @enderror">
            <b class="ls-label-text">Data e hora da saída</b>
            <input type="datetime-local" class="form-control" name="datahorasaidaautorizada" value="{{old('datahorasaidaautorizada')}}" min="{{date('yy-m-d')}}T{{date('H:i', strtotime('-3 hour', strtotime(date('H:i'))))}}">
            @error('datahorasaidaautorizada')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>

        <div class="form-group col-md-3">
          <label class="ls-label col-md-12 @error('datahoraretornoautorizada') ls-error @enderror">
            <b class="ls-label-text">Data e hora do retorno</b>
            <input type="datetime-local" class="form-control" name="datahoraretornoautorizada" value="{{old('datahoraretornoautorizada')}}">

            @error('datahoraretornoautorizada')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>
      </div>
      <!-- LIBERAÇÃO de Utilização do Veiculo -->

        <div class="col-md-12">
          <h5 class="ls-title-6">Quilometragem</h5>
          <div class="form-group col-md-3">
            <label class="ls-label col-md-12 @error('kminicial') ls-error @enderror">
              <b class="ls-label-text">Quilometragem Atual</b>
              <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="kminicial" maxlength="6" autocomplete="off" value="{{old('kminicial')}}">

              @error('kminicial')
              <div class="ls-help-message">
                {{$message}}
              </div>
              @enderror

            </label>
          </div>
          <div class="form-group col-md-3">
            <label class="ls-label col-md-12 @error('kmfinal') ls-error @enderror">
              <b class="ls-label-text">Quilometragem Final</b>
              <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="kmfinal" maxlength="6" autocomplete="off" value="{{old('kmfinal')}}">

              @error('kmfinal')
              <div class="ls-help-message">
                {{$message}}
              </div>
              @enderror

            </label>
          </div>
        </div>

        <div class="col-md-12">
          <h5 class="ls-title-6">Autorização</h5>
          <div class="form-group col-md-3">
            <label class="ls-label col-md-12">
              <b class="ls-label-text">Autorizado por</b>
              <input type="text" class="form-control" name="autorizacao" value="{{Auth::user()->name}}">

            </label>
          </div>
          <div class="form-group col-md-3">
            <label class="ls-label col-md-12 @error('data') ls-error @enderror">
              <b class="ls-label-text">Data</b>
              <input type="date" class="form-control" name="data" placeholder="Data" value="{{old('data')}}" min="{{date('yy-m-d')}}">

              @error('data')
              <div class="ls-help-message">
                {{$message}}
              </div>
              @enderror

            </label>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group col-md-6">
            <label class="ls-label col-md-12 @error('observ') ls-error @enderror">
              <b class="ls-label-text">Obeservação</b>
              <input type="text" class="form-control" name="observ" value="{{old('observ')}}">

              @error('observ')
              <div class="ls-help-message">
                {{$message}}
              </div>
              @enderror

            </label>
          </div>
        </div>
      </div>
      <script type="text/javascript" src="<?php echo asset('js/collapsibleAuth.js') ?>"></script>
      @if($errors->has('namemotorista')
      || $errors->has('veiculo')
      || $errors->has('datahorasaidaautorizada')
      || $errors->has('datahoraretornoautorizada')
      || $errors->has('kminicial')
      || $errors->has('kmfinal')
      || $errors->has('data')
      || $errors->has('observ'))
      <script type="text/javascript">
        var contentDois = document.getElementById("content-02");
        contentDois.style.display = "block";
      </script>
      @endif

    </fieldset>
    <div class="ls-actions-btn">
      <input type="submit" value="Autorizar" class="ls-btn-primary" title="Cadastrar" style="font-weight: bold;">
      <input class="ls-btn-primary-danger" type="reset" value="Limpar" style="font-weight: bold;">
    </div>
  </form>
</div>

@stop