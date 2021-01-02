@extends('layouts.application')

@section('content')
<h1 class="ls-title-intro ls-ico-home">Bem vindo ao WebCar HSJ</h1>

<div class="ls-box ls-board-box">
  <header class="ls-info-header">
    <h2 class="ls-title-3">Dashboard Mês Atual: {{date('m-Y')}}</h2>

  </header>

  @can('View ADM dashboard')
  <div class="col-sm-6 col-md-3 dash">
    <div class="ls-box" style="background-color: #00BFFF;">
      <div class="ls-box-head">
        <h6 class="ls-title-4" style="color: #000; font-weight: bold;">VEICULOS CADASTRADOS</h6>
      </div>
      <div class="ls-box-body">
        <strong>{{ App\Vehicle::count()-2 }}</strong>
      </div>
      <div class="ls-box-footer">
        <div class="box-header">
          <form method="post" action="{{ route('vehicle.list') }}" class="form form-inline">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <fieldset>
            </fieldset>
            <button type="submit" class="ls-btn ls-btn-sm" style="width: 150px; margin-left: auto; margin-right: auto; color: #000; font-weight: bold;">Exibir</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endcan

  @can('View ADM dashboard')
  <div class="col-sm-6 col-md-3 dash">
    <div class="ls-box" style="background-color: 	#CD853F;">
      <div class="ls-box-head">
        <h6 class="ls-title-4" style="color: #000; font-weight: bold;">Veículos em Manutenção</h6>
      </div>
      <div class="ls-box-body">
        <strong>{{ App\Vehicle::where('situacao', 'MANUTENÇÃO')->count() }}</strong>
      </div>
      <div class="ls-box-footer">
        <div class="box-header">
          <form method="post" action="{{ route('vehicle.list') }}" class="form form-inline">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <fieldset>
              <label class="ls-label col-md-12">
                <input type="text" name="situacao" value="MANUTENÇÃO" style="display: none;">
              </label>
            </fieldset>
            <button type="submit" class="ls-btn ls-btn-sm" style="width: 150px; margin-left: auto; margin-right: auto;color: #000; font-weight: bold;">Exibir</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endcan

  @can('View ADM dashboard')
  <div class="col-sm-6 col-md-3 dash">
    <div class="ls-box" style="background-color: 		#48D1CC;">
      <div class="ls-box-head">
        <h6 class="ls-title-4" style="color: #000; font-weight: bold;">Motoristas Cadastrados</h6>
      </div>
      <div class="ls-box-body">
        <strong>{{ App\Driver::all()->count()-1 }}</strong>
      </div>
      <div class="ls-box-footer">
        <div class="box-header">
          <a href="{{ route('drivers') }}" class="ls-btn ls-btn-sm" style="width: 150px; margin-left: auto; margin-right: auto;color: #000; font-weight: bold;">Exibir</a>
        </div>
      </div>
    </div>
  </div>
  @endcan

  
  <div class="col-sm-6 col-md-3 dash">
    <div class="ls-box" style="background-color: #C64B4D;">
      <div class="ls-box-head">
        <h6 class="ls-title-4" style="color: #000; font-weight: bold;">Suas Solicitações Pendentes</h6>
      </div>
      <div class="ls-box-body">
        <strong>{{ App\Solicitacao::where('statussolicitacao', 'PENDENTE')
                    ->where('datasaida', '>', date('Y-m-d', mktime(0, 0, 0, date('m') , 1 , date('Y'))))
                    ->where('user_id', auth()->user()->id)->count() }}</strong>
      </div>
      <div class="ls-box-footer">
        <div class="box-header">
          <form method="post" action="{{ route('solicitacao.list') }}" class="form form-inline">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <fieldset>
              <label class="ls-label col-md-12">
                <input type="text" name="statussolicitacao" value="PENDENTE" style="display: none;">
              </label>
            </fieldset>
            <button type="submit" class="ls-btn ls-btn-sm" style="width: 150px; margin-left: auto; margin-right: auto; color: #000; font-weight: bold;">Exibir</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  

  @can('View ADM dashboard')
  <div class="col-sm-6 col-md-3 dash">
    <div class="ls-box" style="background-color: #F7293D;">
      <div class="ls-box-head">
        <h6 class="ls-title-4" style="color: #000; font-weight: bold;">Autorizações Pendentes</h6>
      </div>
      <div class="ls-box-body">
        <strong>{{ App\Authorizacao::where('statussolicitacao', 'PENDENTE')
            ->where('datasaida', '>', date('Y-m-d', mktime(0, 0, 0, date('m') , 1 , date('Y'))))
            ->count() }}</strong>
      </div>
      <div class="ls-box-footer">
        <div class="box-header">
          <form method="post" action="{{ route('authorizacao.list') }}" class="form form-inline">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <fieldset>
              <label class="ls-label col-md-12">
                <input type="text" name="statussolicitacao" value="PENDENTE" style="display: none;">
              </label>
            </fieldset>
            <button type="submit" class="ls-btn ls-btn-sm" style="width: 150px; margin-left: auto; margin-right: auto; color: #000; font-weight: bold;">Exibir</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endcan

  @can('View ADM dashboard')
  <div class="col-sm-6 col-md-3 dash">
    <div class="ls-box" style="background-color: #87CEFA;">
      <div class="ls-box-head">
        <h6 class="ls-title-4" style="color: #000; font-weight: bold;">Viagens realizadas</h6>
      </div>
      <div class="ls-box-body">
        <strong>{{ App\Authorizacao::where('statussolicitacao', 'REALIZADA')
            ->where('datasaida', '>', date('Y-m-d', mktime(0, 0, 0, date('m') , 1 , date('Y'))))
            ->count() }}</strong>
      </div>
      <div class="ls-box-footer">
        <div class="box-header">
          <form method="post" action="{{ route('authorizacao.list') }}" class="form form-inline">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <fieldset>
              <label class="ls-label col-md-12">
                <input type="text" name="statussolicitacao" value="REALIZADA" style="display: none;">
              </label>
            </fieldset>
            <button type="submit" class="ls-btn ls-btn-sm" style="width: 150px; margin-left: auto; margin-right: auto; color: #000; font-weight: bold;">Exibir</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endcan

  <div class="col-sm-6 col-md-3 dash">
    <div class="ls-box" style="background-color: 	#00BFFF;">
      <div class="ls-box-head">
        <h6 class="ls-title-4" style="color: #000; font-weight: bold;">Suas viagens realizadas</h6>
      </div>
      <div class="ls-box-body">
        <strong>{{ App\Solicitacao::where('statussolicitacao', 'REALIZADA')
                    ->where('datasaida', '>', date('Y-m-d', mktime(0, 0, 0, date('m') , 1 , date('Y'))))
                    ->where('user_id', auth()->user()->id)->count() }}</strong>
      </div>
      <div class="ls-box-footer">
        <div class="box-header">
          <form method="post" action="{{ route('solicitacao.list') }}" class="form form-inline">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <fieldset>
              <label class="ls-label col-md-12">
                <input type="text" name="statussolicitacao" value="REALIZADA" style="display: none;">
              </label>
            </fieldset>
            <button type="submit" class="ls-btn ls-btn-sm" style="width: 150px; margin-left: auto; margin-right: auto; color: #000; font-weight: bold;">Exibir</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
</div>



@endsection