@extends('layouts.application')

@section('content')
<h1 class="ls-title-intro ls-ico-user-add">Autorização de saidas</h1>
<div class="ls-box">

    <form method="Post" action="{{route('authorizacao.edit',$authorizacao->id)}}" class="ls-form row" id="formAuth">
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
                            @inject('sectors', '\App\Sector')
                            @foreach($sectors->getSectors() as $sectors)
                            @if($authorizacao->namesolicitante === $sectors->cc)
                            <input type="text" class="form-control" name="namesolicitante" value="{{$authorizacao->namesolicitante}} - {{$sectors->sector}}" disabled>
                            @endif
                            @endforeach
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
                            <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="nameramal" value="{{$authorizacao->nameramal}}" maxlength="4" autocomplete="off" disabled>

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
                            <input type="text" class="form-control" name="nameroteiro" value="{{$authorizacao->origem}} - {{$authorizacao->destino}}" disabled>

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
                            <input type="text" class="form-control" name="namefinalidade" value="{{$authorizacao->namefinalidade}}" disabled>

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
                        <label class="ls-label col-md-12 @error('datasaida') ls-error @enderror">
                            <b class="ls-label-text">Data da saída</b>
                            <input type="date" class="form-control" name="datasaida" value="{{date('Y-m-d', strtotime($authorizacao->datasaida))}}" disabled>
                            <!-- <input type="datetime-local" class="form-control" name="datahorasaida" value="{{date('Y-m-d', strtotime($authorizacao->datahorasaida))}}T{{date('H:i', strtotime($authorizacao->datahorasaida))}}" min="{{date('Y-m-d')}}T{{date('H:i', strtotime('-3 hour', strtotime(date('H:i'))))}}"> -->
                            @error('datasaida')
                            <div class="ls-help-message">
                                {{$message}}
                            </div>
                            @enderror

                        </label>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="ls-label col-md-12 @error('horasaida') ls-error @enderror">
                            <b class="ls-label-text">Hora da saída</b>
                            <input type="time" class="form-control" name="horasaida" value="{{date('H:i', strtotime($authorizacao->horasaida))}}" disabled>

                            @error('horasaida')
                            <div class="ls-help-message">
                                {{$message}}
                            </div>
                            @enderror

                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group col-md-3">
                        <label class="ls-label col-md-12 @error('dataretorno') ls-error @enderror">
                            <b class="ls-label-text">Data de retorno</b>
                            <input type="date" class="form-control" name="dataretorno" value="{{date('Y-m-d', strtotime($authorizacao->dataretorno))}}" disabled>
                            @error('dataretorno')
                            <div class="ls-help-message">
                                {{$message}}
                            </div>
                            @enderror

                        </label>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="ls-label col-md-12 @error('horaretorno') ls-error @enderror">
                            <b class="ls-label-text">Hora do retorno</b>
                            <input type="time" class="form-control" name="horaretorno" value="{{date('H:i', strtotime($authorizacao->horaretorno))}}" disabled>

                            @error('horaretorno')
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
                            <input type="text" class="form-control" name="nameusuario" placeholder="Separe o nome dos usuários com ponto e virgula ( ; )" value="{{$authorizacao->nameusuario}}" disabled>

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
                    <div class="form-group col-md-3">
                        <label class="ls-label col-md-12  @error('veiculo') ls-error @enderror">
                            <b class="ls-label-text">Motorista</b>
                            @inject('drivers', '\App\Driver')
                            <div class="ls-custom-select">
                                <select name="name_driver" class="ls-select">
                                    @foreach($drivers->getDrivers() as $drivers)
                                    @if($drivers->name_driver == $authorizacao->name_driver)
                                    <option value="{{ $drivers->name_driver }}" selected>{{ $drivers->name_driver }}</option>
                                    @else
                                    <option value="{{ $drivers->name_driver }}">{{ $drivers->name_driver }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            @error('name_driver')
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
                                <select name="veiculo" class="ls-select" id="carId" onchange="controlSts(this.value)">
                                    @foreach($vehicles->getVehicles() as $vehicles)
                                    @if($authorizacao->veiculo == $vehicles->id)
                                    <option value="{{ $authorizacao->veiculo }}" selected>{{ $vehicles->brand }} {{ $vehicles->model }} -
                                        {{ $vehicles->placa}}
                                    </option>
                                    @endif
                                    @if(($vehicles->situacao == "LIVRE" || $vehicles->situacao == null) && $authorizacao->veiculo != $vehicles->id)
                                    <option value="{{ $vehicles->id }}">{{ $vehicles->brand }} {{ $vehicles->model }} -
                                        {{ $vehicles->placa}}
                                    </option>
                                    @else

                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            @error('veiculo')
                            <div class="ls-help-message">
                                {{$message}}
                            </div>
                            @enderror
                            <b id="labelUnauthorized" class="ls-label-text" style="font-size: 10px; color: red; display: none; ">Atualize para salvar o novo veículo, <br> ou atualize com status 'PENDENTE' para analisar depois.</b>
                        </label>
                    </div>
                    <div class="form-group col-md-3">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="ls-label col-md-12 @error('statussolicitacao') ls-error @enderror">
                            <script type="text/javascript" src="<?php echo asset('../js/changeinp.js') ?>"></script>
                            <b class="ls-label-text">Situação</b>
                            <div class="ls-custom-select">
                                <select id="sit" name="statussolicitacao" class="ls-select" onchange="verifica(this.value)" @if( $authorizacao->statussolicitacao == "PENDENTE") style="background-color: red; color: #fff; font-weight: bold;" @elseif ( $authorizacao->statussolicitacao == "AUTORIZADA") style="background-color: green; color: #fff; font-weight: bold;" @elseif ( $authorizacao->statussolicitacao == "EM ANALISE") style="background-color: blue; color: #fff; font-weight: bold;" @elseif ( $authorizacao->statussolicitacao == "REALIZADO") style="background-color: MediumAquamarine; color: #fff; font-weight: bold;" @endif>
                                    @if($authorizacao->statussolicitacao === "AUTORIZADA")
                                    <option style="background-color: green; color: #fff; font-weight: bold;" value="AUTORIZADA">AUTORIZADA</option>
                                    <option style="background-color: red; color: #fff; font-weight: bold;" value="PENDENTE">PENDENTE</option>
                                    <option id="sts_realizada" style="background-color: MediumAquamarine; color: #fff; font-weight: bold;" value="REALIZADA">REALIZADA</option>
                                    <option id="sts_nao_realizada" style="background-color: blue; color: #fff; font-weight: bold;" value="NÃO REALIZADA">NÃO REALIZADA</option>
                                    @else
                                    <option style="background-color: red; color: #fff; font-weight: bold;" value="PENDENTE">PENDENTE</option>
                                    <option style="background-color: green; color: #fff; font-weight: bold;" value="AUTORIZADA">AUTORIZADA</option>
                                    @endif
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
                        <label class="ls-label col-md-12 @error('datasaidaautorizada') ls-error @enderror">
                            <b class="ls-label-text">Data da saída</b>
                            <input type="date" class="form-control" name="datasaidaautorizada" @if($authorizacao->datasaidaautorizada != null)
                            value="{{date('Y-m-d', strtotime($authorizacao->datasaidaautorizada))}}"
                            @endif>
                            <!-- <input type="datetime-local" class="form-control" name="datahorasaidaautorizada" @if($authorizacao->datahorasaidaautorizada != null)
                            value="{{date('Y-m-d', strtotime($authorizacao->datahorasaidaautorizada))}}T{{date('H:i', strtotime($authorizacao->datahorasaidaautorizada))}}"
                            @endif
                            min="{{date('Y-m-d')}}T{{date('H:i', strtotime('-3 hour', strtotime(date('H:i'))))}}"> -->

                            @error('datasaidaautorizada')
                            <div class="ls-help-message">
                                {{$message}}
                            </div>
                            @enderror

                        </label>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="ls-label col-md-12 @error('horasaidaautorizada') ls-error @enderror">
                            <b class="ls-label-text">Hora da saida</b>
                            <input type="time" class="form-control" name="horasaidaautorizada" @if($authorizacao->horasaidaautorizada != null)
                            value="{{date('H:i', strtotime($authorizacao->horasaidaautorizada))}}"
                            @endif>

                            @error('horasaidaautorizada')
                            <div class="ls-help-message">
                                {{$message}}
                            </div>
                            @enderror
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group col-md-3">
                        <label class="ls-label col-md-12 @error('dataretornoautorizada') ls-error @enderror">
                            <b class="ls-label-text">Data do retorno</b>
                            <input type="date" class="form-control" name="dataretornoautorizada" @if($authorizacao->dataretornoautorizada != null)
                            value="{{date('Y-m-d', strtotime($authorizacao->dataretornoautorizada))}}"
                            @endif
                            min="{{date('Y-m-d')}}T{{date('H:i', strtotime('-3 hour', strtotime(date('H:i'))))}}">
                            @error('dataretornoautorizada')
                            <div class="ls-help-message">
                                {{$message}}
                            </div>
                            @enderror

                        </label>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="ls-label col-md-12 @error('horaretornoautorizada') ls-error @enderror">
                            <b class="ls-label-text">Hora do retorno</b>
                            <input type="time" class="form-control" name="horaretornoautorizada" @if($authorizacao->horaretornoautorizada != null)
                            value="{{date('H:i', strtotime($authorizacao->horaretornoautorizada))}}"
                            @endif>

                            @error('horaretornoautorizada')
                            <div class="ls-help-message">
                                {{$message}}
                            </div>
                            @enderror
                        </label>
                    </div>
                </div>
                <!-- LIBERAÇÃO de Utilização do Veiculo -->

                <div id="mileage" class="col-md-12" style="display: none">
                    <div class="form-group col-md-3">
                        <label class="ls-label col-md-12 @error('kminicial') ls-error @enderror">
                            <b class="ls-label-text">Quilometragem inicial</b>
                            <input type="text" id="kminicial" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="kminicial" maxlength="6" autocomplete="off" value="{{$authorizacao->kminicial}}">

                            @error('kminicial')
                            <div class="ls-help-message">
                                {{$message}}
                            </div>
                            @enderror

                        </label>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="ls-label col-md-12 @error('kmfinal') ls-error @enderror">
                            <b class="ls-label-text">Quilometragem final</b>
                            <input type="text" id="kmfinal" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="kmfinal" maxlength="6" autocomplete="off" value="{{$authorizacao->kmfinal}}">

                            @error('kmfinal')
                            <div class="ls-help-message">
                                {{$message}}
                            </div>
                            @enderror

                        </label>
                    </div>
                    <script>
                        function kmfinalMaiorMenor() {
                            var el = document.getElementById("kmfinal").value;
                            var el2 = document.getElementById("kminicial").value;
                            var displayEl = document.getElementById("mileage").style.display;
                            if (el < el2 && displayEl == "block") {
                                alert("A quilometragem Final precisa ser maior que " + el2);
                                $("#formAuth").submit(function() {
                                    return false;
                                });
                                window.location.reload();
                            }
                        }
                    </script>

                </div>

                <div class="col-md-12">
                    <h5 class="ls-title-6">Autorização</h5>
                    <div class="form-group col-md-3">
                        <label class="ls-label col-md-12">
                            <b class="ls-label-text">Autorizado por</b>
                            <input type="text" class="form-control" name="autorizacao" value="{{$authorizacao->autorizacao}}" disabled>

                        </label>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="ls-label col-md-12 @error('data') ls-error @enderror">
                            <b class="ls-label-text">Data</b>
                            <input type="date" class="form-control" name="data" placeholder="Data" value="{{$authorizacao->data}}" min="{{date('Y-m-d')}}" disabled>

                            @error('data')
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
            <input type="submit" value="Atualizar" class="ls-btn-dark" title="update" style="font-weight: bold; background-color: blue;" onclick="kmfinalMaiorMenor()">
            <a href="{{ route('authorizacoes') }}" class="ls-btn-primary-danger" style="font-weight: bold;">Cancelar</a>
        </div>
    </form>
</div>

@stop