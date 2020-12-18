@extends('layouts.application')

@section('content')
<h1 class="ls-title-intro ls-ico-plus">Listar Custos</h1>
<div class="ls-box">
  <div class="box-header">
    <h5 class="ls-title">Listar Custo</h5>

    <form method="post" action="{{ route('expense.list') }}" class="form form-inline">
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      <fieldset>
        <label class="ls-label col-md-12">
          <div class="col-md-4">
            <input type="text" name="name_expense" placeholder="Custo">
          </div>
          <div class="col-md-1">ou</div>
          <div class="col-md-4">
            <input type="text" name="data" placeholder="Data">
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
        <th>Custo</th>
        <th>Categoria</th>
        <th>Veículo</th>
        <th>Valor unitário</th>
        <th>Quantidade</th>
        <th>Desconto(%)</th>
        <th>Valor total</th>
        <th>Data</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>


      @foreach ($expenses as $expense)
      <tr>

        <td>{{ $expense->name_expense }}</td>
        @inject('categories', '\App\Category')
        @foreach($categories->getCategories() as $categories)
        @if($categories->id == $expense->category_id)
        <td>{{$categories->name}}</td>
        @endif
        @endforeach
        @foreach ($vehicles as $vehicle)
        @if($vehicle->id == $expense->vehicle_id)
        <td> {{$vehicle->model}} {{$vehicle->brand}} {{$vehicle->placa}}</td>
        @endif
        @endforeach
        <td>R$ {{ $expense->unitary_value }}</td>
        <td>{{ $expense->amount}}</td>
        <td>% {{ $expense->discount}}</td>
        <td>R$ {{ $expense->amount_paid}}</td>
        <td>{{ $expense->data}}</td>
        <td>
          <?php
            $dateNow = date('Y-m-d H:i:s'); //2020-11-26 13:45:29
            $dateDay = date('d'); //
            $dateMonth = date('m'); //
            $dateYear = date('Y'); //
            $amountMonth = date("t"); //ultimo dia do mês
            $sevenDay = $amountMonth - 7; //
            $allowedStartDateExpense = $dateYear . '-'. $dateMonth . '-' . $sevenDay . ' 23:59:59'; //2020-11-23 23:59:59
            $firtsMonthDate = $dateYear . '-'. $dateMonth . '-01 00:00:00'; //2020-11-01 00:00:00
          ?>
          @if((($dateNow > $firtsMonthDate) && ($dateNow < $allowedStartDateExpense)) && (($expense->data > $firtsMonthDate) && ($expense->data < $allowedStartDateExpense)))
            <a class="ls-ico-pencil ls-btn-dark" style="background-color: blue;" href="{{ route('expense.edit', $expense->id) }}"></a>
            <a class="ls-ico-remove ls-btn-primary-danger" href="{{ route('expense.delete', $expense->id) }}"></a>
          @else
            @can('SUPER ADM')
              <a class="ls-ico-pencil ls-btn-dark" style="background-color: blue;" href="{{ route('expense.edit', $expense->id) }}"></a>
              <a class="ls-ico-remove ls-btn-primary-danger" href="{{ route('expense.delete', $expense->id) }}"></a>
            @endcan
          @endif  
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop