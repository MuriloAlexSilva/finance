@extends('layouts.app')

@section('content')
{{-- @dd($expense) --}}
  <div class="container container-fluid" style="margin-top:100px; width:80% ">
    <div class="row mb-3 h4 col-md-12">
    {{-- @dd() --}}
      <div class="col-md-6"><strong>{{$dateToday->format('M/Y')}}</strong></div>
      <div class="col-md-1 offset-3">
        <a href="{{route('revenue.create')}}" class="btn">
          <i class="fa fa-plus-circle text-success fa-2x"></i>
        </a>
      </div>
      <div class="col-md-1">
        <a href="{{route('expense.create')}}" class="btn">
          <i class="fa fa-plus-circle text-danger fa-2x"></i>
        </a>
      </div>
    </div>
    <div class="row" style="height:100px">
      <div class="row col-md-3 bg-white rounded align-items-center" style="">
        <div class="h3 text-success col-md-3">
          <i class="fa fa-arrow-down" aria-hidden="true"></i>
        </div>
        <div class="h5 col-md-9">
          <strong>R$ {{ number_format($revenue, 2, ',', '.') }}</strong>
        </div>
      </div>
      <div class="row col-md-3 bg-white align-items-center offset-1 rounded">
        <div class="h3 text-danger col-md-3">
          <i class="fa fa-arrow-up" aria-hidden="true"></i>
        </div>
        <div class="h5 col-md-9">
          <strong>R$ -{{ number_format($expense, 2, ',', '.') }}</strong>
        </div>
      </div>
      <div class="row col-md-3 bg-white offset-1 rounded align-items-center">
        <div class="h3 text-info col-md-3">
          <i class="fa fa-university" aria-hidden="true"></i>
        </div>
        <div class="h5 col-md-9">
          <strong>R$ 50.000,00</strong>
        </div>
      </div>
    </div>

  </div>
@endsection