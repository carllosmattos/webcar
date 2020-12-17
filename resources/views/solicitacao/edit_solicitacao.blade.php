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

            <?php $tags =  $solicitacao->nameroteiro;
            $tagsArray = explode(' - ', $tags); ?>

            <div class="col-md-12">
                <div class="form-group col-md-3">
                    <label class="ls-label col-md-12 @error('nameroteiro') ls-error @enderror">
                        <b class="ls-label-text">Origem</b>
                        <input value="<?php echo $tagsArray[0] ?>" type="text" class="form-control" name="nameroteiro[]" placeholder="Roteiro">

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
                        <input value="<?php echo $tagsArray[1] ?>" type="text" class="form-control" name="nameroteiro[]" placeholder="Roteiro">

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
                    <label class="ls-label col-md-12 @error('datahorasaida') ls-error @enderror">
                        <b class="ls-label-text">Data e hora da saída</b>
                        <input type="datetime-local" class="form-control" name="datahorasaida" value="{{date('Y-m-d', strtotime($solicitacao->datahorasaida))}}T{{date('H:i', strtotime($solicitacao->datahorasaida))}}" min="{{date('Y-m-d')}}T{{date('H:i', strtotime('-3 hour', strtotime(date('H:i'))))}}">
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
                        <input type="datetime-local" class="form-control" name="datahoraretorno" value="{{date('Y-m-d', strtotime($solicitacao->datahoraretorno))}}T{{date('H:i', strtotime($solicitacao->datahoraretorno))}}">

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