@extends('layouts.application')

@section('content')
<h1 class="ls-title-intro ls-ico-code">Editar Solicitação</h1>
<div class="ls-box">

    <h5 class="ls-title-5">Solicitação de uso de veiculos oficiais:</h5>
    <hr>
    <form method="Post" action="{{route('solicitacao.edit',$solicitacao->id)}}" class="ls-form row">
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
                                @if($solicitacao->namesolicitante === $sectors->cc)
                                <option value="{{$sectors->cc}}" class=" form-control" selected>{{$sectors->cc}} - {{$sectors->sector}}</option>
                                @endif
                                <option value="{{$sectors->cc}}" class=" form-control">{{$sectors->cc}} - {{$sectors->sector}}</option>
                                @endforeach
                            </select>
                        </div>
                    </label>

                </div>

                <div class="form-group col-md-3">
                    <label class="ls-label col-md-12 @error('nameramal') ls-error @enderror">
                        <b class="ls-label-text">Ramal</b>
                        <input value="{{ $solicitacao->nameramal }}" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="nameramal" placeholder="Ramal" maxlength="5" autocomplete="off">

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
                    <label class="ls-label col-md-12 @error('origem') ls-error @enderror">
                        <b class="ls-label-text">Origem</b>
                        <input type="text" class="form-control" name="origem" value="{{$solicitacao->origem}}">

                        @error('origem')
                        <div class="ls-help-message">
                            {{$message}}
                        </div>
                        @enderror

                    </label>
                </div>
                <div class="form-group col-md-3">
                    <label class="ls-label col-md-12 @error('destino') ls-error @enderror">
                        <b class="ls-label-text">Destino</b>
                        <input type="text" class="form-control" name="destino" value="{{$solicitacao->destino}}">

                        @error('destino')
                        <div class="ls-help-message">
                            {{$message}}
                        </div>
                        @enderror

                    </label>
                </div>

                <div class="form-group col-md-3">
                    <label class="ls-label col-md-12 @error('namefinalidade') ls-error @enderror">
                        <b class="ls-label-text">Finalidade</b>
                        <input value="{{ $solicitacao->namefinalidade }}" type="text" class="form-control" name="namefinalidade" placeholder="Finalidade">

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
                        <input type="date" class="form-control" name="datasaida" value="{{date('Y-m-d', strtotime($solicitacao->datasaida))}}">
                        <!-- <input type="datetime-local" class="form-control" name="datahorasaida" value="{{date('Y-m-d', strtotime($solicitacao->datahorasaida))}}T{{date('H:i', strtotime($solicitacao->datahorasaida))}}" min="{{date('Y-m-d')}}T{{date('H:i', strtotime('-3 hour', strtotime(date('H:i'))))}}"> -->
                        @error('datasaida')
                        <div class="ls-help-message">
                            {{$message}}
                        </div>
                        @enderror

                    </label>
                </div>

                <div class="form-group col-md-3">
                    <label class="ls-label col-md-12 @error('horasaida') ls-error @enderror">
                        <b class="ls-label-text">Hora do saída</b>
                        <input type="time" class="form-control" name="horasaida" value="{{date('H:i', strtotime($solicitacao->horasaida))}}">

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
                        <input type="date" class="form-control" name="dataretorno" value="{{date('Y-m-d', strtotime($solicitacao->dataretorno))}}">
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
                        <input type="time" class="form-control" name="horaretorno" value="{{date('H:i', strtotime($solicitacao->horaretorno))}}">

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
                        <input value="{{ $solicitacao->nameusuario }}" type="text" class="form-control" name="nameusuario" placeholder="Separe o nome dos usuários com ponto e virgula ( ; )">

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
            <input type="submit" value="Atualizar" class="ls-btn-dark" title="update" style="font-weight: bold; background-color: blue;">
            <a href="{{ route('solicitacoes') }}" class="ls-btn-primary-danger" style="font-weight: bold;">Cancelar</a>
        </div>
    </form>
</div>

@stop