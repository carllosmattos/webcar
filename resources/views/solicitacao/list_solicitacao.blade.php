@extends('layouts.application')

@section('content')
<h1 class="ls-title-intro ls-ico-code">Listar Solicitações</h1>
<div class="table-responsive">
	<div class="ls-box ">
		<div class="box-header">
			<form method="post" action="{{ route('solicitacao.list') }}" class="form form-inline col-md-6" style="margin-bottom: 10px;">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<fieldset>
					<label class="ls-label col-md-12">
						<div class="col-md-12">
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

		<table class="ls-table ls-table-striped ls-bg-header ">
			<thead>
				<tr>
					<th>Setor Solicitante</th>
					<th>Ramal</th>
					<th>Roteiro</th>
					<th>Finalidade</th>
					<th>Saída</th>
					<th>Retorno</th>
					<th>Nome dos Usuários</th>
					<th>Status</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($solicitacoes as $solicitacao)
				<tr>
					@inject('sectors', '\App\Sector')
					@foreach($sectors->getSectors() as $sectors)
						@if($sectors->cc === $solicitacao->namesolicitante)
						<td>{{ $sectors->sector }}</td>
						@else
						@endif
					@endforeach
					<td>{{ $solicitacao->nameramal }}</td>
					<td>{{ $solicitacao->origem }} - {{ $solicitacao->destino }}</td>
					<td>{{ $solicitacao->namefinalidade }}</td>
					<td>Data: {{date('d-m-Y', strtotime($solicitacao->datasaida))}} </br>Hora: {{date('H:i', strtotime($solicitacao->horasaida))}}</td>
					<td>Data: {{date('d-m-Y', strtotime($solicitacao->dataretorno))}} </br>Hora: {{date('H:i', strtotime($solicitacao->horaretorno))}}</td>
					<td>{{ $solicitacao->nameusuario }}</td>
					@if($solicitacao->statussolicitacao == "PENDENTE")
					<td><label class="ls-ico-history" style="color: red;"> {{ $solicitacao->statussolicitacao }}</label></td>
					@elseif($solicitacao->statussolicitacao == "AUTORIZADA")
					<td><label class="ls-ico-thumbs-up" style="color: green;"> {{ $solicitacao->statussolicitacao }}</label></td>
					@elseif($solicitacao->statussolicitacao == "REALIZADA")
					<td><label class="ls-ico-checkmark" style="color: Mediumaquamarine;"> {{ $solicitacao->statussolicitacao }}</label></td>
					@else
					<td><label class="ls-ico-eye" style="color: blue;"> {{ $solicitacao->statussolicitacao }}</label></td>
					@endif

					<!-- Ações -->
					<td>
						<div class="col-12">
							<div class="col-md-4">
								@if($solicitacao->statussolicitacao == "PENDENTE")
								<a class="ls-ico-pencil ls-btn-dark" style="background-color: blue;" href="{{ route('solicitacao.edit', $solicitacao->id) }}"></a>
								@else
								@endif
							</div>
							<div class="col-md-4">
								@if($solicitacao->statussolicitacao == "PENDENTE")
								<a class="ls-ico-remove ls-btn-primary-danger" href="{{ route('solicitacao.delete', $solicitacao->id) }}"></a>
								@else
								@endif
							</div>
							<div class="col-md-4">
								@if(($solicitacao->statussolicitacao != "NÃO REALIZADA"))
								<a class="ls-ico-windows ls-btn" href="{{ route('pdf', $solicitacao->id) }}"></a>
								@endif
							</div>
						</div>

					</td>
					<!-- Ações -->

				</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>
@stop