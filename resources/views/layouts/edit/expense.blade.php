@extends('layouts.app')

@section('content')
  <div class="container container-fluid" style="margin-top:100px; width:70%">
    <div class="row">
      <div class="col-11">
        @if(isset($item))
          <h3>Editando Despesas</h3>
        @else
          <h3>Cadastro de Despesas</h3>
        @endif
      </div>
      <div class="">
        <a href="{{route('expense.index')}}" class="btn btn-danger">
          <i class="fa fa-arrow-left "></i>
        </a>
      </div>
    </div>
    <div class="pt-5" style="">
      @if(isset($item))
        <form action="{{route('expense.update',$item->id_expense)}}" method="POST">
          @method('PUT')
      @else
        <form action="{{route('expense.store')}}" method="POST">
      @endif  
        @csrf

        <div class="form-group row">
          <label for="id_expense_type" class="col-md-4 col-form-label text-md-right obg">{{ __('Tipo de Despesa') }}</label>
          <div class="col-md-7">
            <select name="id_expense_type" id="id_expense_type" class="form-control form-select" placeholder="Selecione um Tipo de Despesa">
              {{-- <option class="optionNull" value="-1">Selecione uma opção</option> --}}
              @foreach($expenseTypeList as $expenseType)
                @if((isset($item) && $item->id_expense_type == $expenseType->id_expense_type))
                  <option value="{{ $expenseType->id_expense_type }}" selected>{{ $expenseType->name }}</option>
                @else
                  <option value="{{ $expenseType->id_expense_type }}">{{ $expenseType->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group row pt-4">
          <label for="id_expense_sub_type" class="col-md-4 col-form-label text-md-right obg">{{ __('Subtipo de Despesa') }}</label>
          <div class="col-md-7">
            <select name="id_expense_sub_type" id="id_expense_sub_type" class="form-control form-select" placeholder="Selecione um Subtipo de Despesa">
              {{-- <option class="optionNull" value="-1">Selecione uma opção</option> --}}
              @foreach($expenseSubTypeList as $expenseSubType)
                @if((isset($item) && $item->id_expense_sub_type == $expenseSubType->id_expense_sub_type))
                  <option value="{{ $expenseSubType->id_expense_sub_type }}" selected>{{ $expenseSubType->name }}</option>
                @else
                  <option value="{{ $expenseSubType->id_expense_sub_type }}">{{ $expenseSubType->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group row pt-4">
          <label for="is_recurrent" class="col-md-4 col-check-label text-md-right">{{ __('É uma Despesa Recorrente?') }}</label>
          <div class="col-md-1 form-check-lg">
            <input name="is_recurrent" id="is_recurrent" type="checkbox" class="form-check-input"
                  {{-- onchange="OnIsCompanyClicked()" --}}
                  name="is_recurrent" value="1"
                  {{ old('is_recurrent') != null ? 'checked' : (isset($item) && $item->is_recurrent ? 'checked' : '') }}
                  autocomplete="is_recurrent">
          </div>
        </div>

        <div class="form-group row pt-4">
          <label for="is_installments" class="col-md-4 col-check-label text-md-right">{{ __('É parcelada?') }}</label>
          <div class="col-md-1 form-check-lg">
            <input name="is_installments" id="is_installments" type="checkbox" class="form-check-input"
                  {{-- onchange="OnIsCompanyClicked()" --}}
                  name="is_installments" value="1"
                  {{ old('is_installments') != null ? 'checked' : (isset($item) && $item->is_installments ? 'checked' : '') }}
                  autocomplete="is_installments">
          </div>
        </div>

       <div class="form-group row pt-4 ">
          <label for="value" class="col-md-4 col-form-label text-md-right obg">{{ __('Valor') }}</label>
          <div class="col-md-3">
            <input type="text" id="value" class="money-entry form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') != null ? old('value') : (isset($item) ? $item->value : '') }}" required autocomplete="value"  required></input>
            @error('value')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>


        <div class="form-group row pt-4">
          <label for="date" class="col-md-4 col-form-label text-md-right obg">{{ __('Data') }}</label>
          <div class="col-md-5">
            <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') != null ? old('date') : (isset($item) ? \Carbon\Carbon::parse($item->date)->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d')) }}" required autocomplete="date">
            @error('date')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="form-group row pt-4">
          <label for="description" class="col-md-4 col-form-label text-md-right obg">{{ __('Descrição') }}</label>
          <div class="col-md-8">
            <input type="text" id="description" class="form-control @error('description') is-invalid @enderror" name="description"  value='{{ old("description") ? old("description") : (isset($item) ? $item->description : "")  }}'/>
            @error('description')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        
        <div class="form-group row mb-0" style="margin-top: 50px;">
          <div class="col-2 offset-8">
            <button id="btnSubmit" name="btnSubmit" class="btn btn-success" type="submit">
              {{__('Salvar')}}
            </button>
          </div>
        <div>

      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function()
    {
      $('.money-entry').mask('#.##0,00', {reverse: true});
    });
  </script>
@endsection