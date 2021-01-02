@extends('layouts.application')

@section('content')

<h1 class="ls-title-intro ls-ico-plus">Editar Custo</h1>
<div class="ls-box">
  <hr>
  <h5 class="ls-title-5">Editar custo:</h5>
  <form method="POST" action="{{route('expense.edit',$expense->id)}}" class="ls-form row">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

    <fieldset>

      <div class="col-md-12">
        <div class="form-group col-md-4">
          <label class="ls-label col-md-12 @error('name_expense') ls-error @enderror">
            <b class="ls-label-text">custo:</b>
            <input type="text" name="name_expense" value="{{$expense->name_expense}}">

            @error('name_expense')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>
        <div class="form-group col-md-4">
          <label class="ls-label col-md-12  @error('category_id') ls-error @enderror">
            <b class="ls-label-text">Categoria</b>
            @inject('categories', '\App\Category')
            <div class="ls-custom-select">
              <select name="category_id" class="ls-select">
                @foreach($categories->getCategories() as $categories)
                @if($expense->category_id == $categories->id)
                <option value="{{ $expense->category_id }}" selected>{{ $categories->name }}</option>
                @elseif($expense->category_id != $categories->id)
                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                @else
                @endif
                @endforeach
              </select>
            </div>

            @error('category_id')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group col-md-4">
          <label class="ls-label col-md-12 @error('unitary_value') ls-error @enderror">
            <b class="ls-label-text">Valor unitário:</b>
            <input type="number" step="any" name="unitary_value" class="ls-no-spin form-control" value="{{$expense->unitary_value}}">

            @error('unitary_value')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>
        <div class="form-group col-md-4">
          <label class="ls-label col-md-12 @error('amount') ls-error @enderror">
            <b class="ls-label-text">Quantidade:</b>
            <input type="number" name="amount" class="ls-no-spin form-control" value="{{$expense->amount}}">

            @error('amount')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group col-md-4">
          <label class="ls-label col-md-12 @error('discount') ls-error @enderror">
            <b class="ls-label-text">Desconto (%):</b>
            <input type="number" step="any" name="discount" value="{{$expense->discount}}">

            @error('discount')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>
        <div class="form-group col-md-2">
          <label class="ls-label col-md-12 @error('data') ls-error @enderror">
            <b class="ls-label-text">Data</b>
            <input class="ls-no-spin" type="date" name="data" value="{{date('d-m-Y', strtotime($expense->data))}}">

            @error('data')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>
        <div class="form-group col-md-2">
          <label class="ls-label col-md-12 @error('hora') ls-error @enderror">
            <b class="ls-label-text">Hora</b>
            <input class="ls-no-spin" type="time" name="hora" value="{{date('H:i', strtotime($expense->hora))}}">

            @error('hora')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group col-md-4">
          <label class="ls-label col-md-12 @error('vehicle_id') ls-error @enderror">
            <b class="ls-label-text">Veículo</b>
            <div class="ls-custom-select">
              <select name="vehicle_id" class="ls-select">
                @foreach($vehicles as $vehicle)

                @if(($vehicle->id) == ($expense->vehicle_id))
                <option value="{{$vehicle->id}}">{{$vehicle->model}} - {{$vehicle->brand}} - {{$vehicle->placa}}</option>
                @endif

                @endforeach
              </select>
            </div>
          </label>
        </div>
      </div>

    </fieldset>

    <div class="ls-actions-btn">
      <input type="submit" value="Atualizar" class="ls-btn-dark" title="update" style="font-weight: bold; background-color: blue;">
      <a href="{{ route('expenses') }}" class="ls-btn-primary-danger" style="font-weight: bold;">Cancelar</a>
    </div>
  </form>
</div>


@stop