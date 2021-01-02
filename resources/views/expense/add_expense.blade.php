@extends('layouts.application')

@section('content')

<h1 class="ls-title-intro ls-ico-plus">Adicionar Despesa</h1>
<div class="ls-box">
  <hr>
  <h5 class="ls-title-5">Cadastrar Despesa:</h5>
  <form method="POST" action="{{ route('expense.postAdd') }}" class="ls-form row">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <fieldset>


      <div class="col-md-12">
        <div class="form-group col-md-4">
          <label class="ls-label col-md-12 @error('name_expense') ls-error @enderror">
            <b class="ls-label-text">custo:</b>
            <input type="text" name="name_expense" value="{{old('name_expense')}}">

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
                  <option value="{{ $categories->id }}">{{ $categories->name }}</option>
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
            <input type="number" step="any" name="unitary_value" class="ls-no-spin form-control" value="{{old('unitary_value')}}">

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
            <input type="number" name="amount" class="ls-no-spin form-control" value="{{old('amount')}}">

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
            <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" name="discount" value="{{old('discount')}}">

            @error('discount')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>
        <div class="form-group col-md-4">
          <label class="ls-label col-md-6 @error('data') ls-error @enderror">
            <b class="ls-label-text">Data</b>
            <input class="ls-no-spin" type="date" name="data" value="{{old('data')}}">

            @error('data')
            <div class="ls-help-message">
              {{$message}}
            </div>
            @enderror

          </label>
        </div>
        <div class="form-group col-md-4">
          <label class="ls-label col-md-6 @error('hora') ls-error @enderror">
            <b class="ls-label-text">Data</b>
            <input class="ls-no-spin" type="time" name="data" value="{{old('hora')}}">

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

                @if(($vehicle->id) == (array_keys($_GET)[0]))
                <option value="{{$vehicle->id}}">{{$vehicle->brand}} - {{$vehicle->model}} - {{$vehicle->placa}}</option>
                @endif

                @endforeach
              </select>
            </div>
          </label>
        </div>
      </div>

    </fieldset>

    <div class="ls-actions-btn">
      <input type="submit" value="Cadastrar" class="ls-btn-primary" title="Cadastrar" style="font-weight: bold;">
      <input class="ls-btn-primary-danger" type="reset" value="Limpar" style="font-weight: bold;">
    </div>
  </form>

</div>


@stop