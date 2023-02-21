@extends('layouts.app')

@section('content')
  <div class="container container-fluid" style="margin-top:100px; width:70%">
    <div class="row">
      <div class="col-11">
        @if(isset($item))
          <h3>Editando Receitas</h3>
        @else
          <h3>Cadastro de Receitas</h3>
        @endif
      </div>
      <div class="">
        <a href="{{route('revenue.index')}}" class="btn btn-danger">
          <i class="fa fa-arrow-left "></i>
        </a>
      </div>
    </div>
    <div class="pt-5" style="">
      @if(isset($item))
        <form action="{{route('revenue.update',$item->id_revenue)}}" method="POST">
          @method('PUT')
      @else
        <form action="{{route('revenue.store')}}" method="POST">
      @endif  
        @csrf

        <div class="form-group row">
          <label for="id_revenue_type" class="col-md-4 col-form-label text-md-right obg">{{ __('Tipo de Receita') }}</label>
          <div class="col-md-7">
            <select name="id_revenue_type" id="id_revenue_type" class="form-control form-select" placeholder="Selecione um Tipo de Receita">
              {{-- <option class="optionNull" value="-1">Selecione uma opção</option> --}}
              @foreach($revenueTypeList as $revenueType)
                @if((isset($item) && $item->id_revenue_type == $revenueType->id_revenue_type))
                  <option value="{{ $revenueType->id_revenue_type }}" selected>{{ $revenueType->name }}</option>
                @else
                  <option value="{{ $revenueType->id_revenue_type }}">{{ $revenueType->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group row pt-4">
          <label for="id_revenue_sub_type" class="col-md-4 col-form-label text-md-right obg">{{ __('Subtipo de Receita') }}</label>
          <div class="col-md-7">
            <select name="id_revenue_sub_type" id="id_revenue_sub_type" class="form-control form-select" placeholder="Selecione um Tipo de Receita">
              {{-- <option class="optionNull" value="-1">Selecione uma opção</option> --}}
              @foreach($revenueSubTypeList as $revenueSubType)
                @if((isset($item) && $item->id_revenue_sub_type == $revenueSubType->id_revenue_sub_type))
                  <option value="{{ $revenueSubType->id_revenue_sub_type }}" selected>{{ $revenueSubType->name }}</option>
                @else
                  <option value="{{ $revenueSubType->id_revenue_sub_type }}">{{ $revenueSubType->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group row pt-4">
          <label for="is_recurrent" class="col-md-4 col-check-label text-md-right">{{ __('É uma Receita Recorrente?') }}</label>
          <div class="col-md-1 form-check-lg">
            <input name="is_recurrent" id="is_recurrent" type="checkbox" class="form-check-input"
                  {{-- onchange="OnIsCompanyClicked()" --}}
                  name="is_recurrent" value="1"
                  {{ old('is_recurrent') != null ? 'checked' : (isset($item) && $item->is_recurrent ? 'checked' : '') }}
                  autocomplete="is_recurrent">
          </div>
        </div>

        {{-- @if(isset($item))
          <div class="form-group row pt-4">
            <label for="" class="col-md-4 col-form-label text-md-right">{{ 'Valor' }}</label>
            <div class="col-md-7">
              <label for="" class="form-control">{{ $item->value }}</label>
            </div>
          </div>
        @else --}}
          <div class="form-group row pt-4 ">
            <label for="value" class="col-md-4 col-form-label text-md-right obg">{{ __('Valor') }}</label>
            <div class="col-md-3">
              <input type="text" id="value" class="money form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') != null ? old('value') : (isset($item) ? $item->value : '') }}" required autocomplete="value"  required></input>
              @error('value')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        {{-- @endif --}}

        {{-- @if(isset($item))
          <div class="form-group row pt-4">
            <label for="" class="col-md-4 col-form-label text-md-right">{{ 'Data' }}</label>
            <div class="col-md-7">
              <label for="" class="form-control">{{ \Carbon\Carbon::parse($item->date)->format("d/m/Y") }}</label>
            </div>
          </div>
        @else --}}
        {{-- @dd($item->date) --}}
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
        {{-- @endif --}}
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
      $('.money').mask('#.##0,00', {reverse: true});
    });
  </script>
@endsection