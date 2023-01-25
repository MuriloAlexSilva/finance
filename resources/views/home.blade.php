@extends('layouts.app')

@section('content')
{{-- @dd($expense) --}}
  <div class="container container-fluid mt-4">
    <div class="row mb-3 h4 col-md-12">
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

    <div class="row" style="height:100px" >
      <div class="row col-md-3 rounded align-items-center" style="background-color:Gainsboro;">
        <div class="h3 text-success col-md-3">
          <i class="fa fa-arrow-down" aria-hidden="true"></i>
        </div>
        <div class="h5 col-md-9">
          <strong>R$ {{ number_format($revenue, 2, ',', '.') }}</strong>
        </div>
      </div>
      <div class="row col-md-3 align-items-center offset-1 rounded" style="background-color:Gainsboro;">
        <div class="h3 text-danger col-md-3">
          <i class="fa fa-arrow-up" aria-hidden="true"></i>
        </div>
        <div class="h5 col-md-9">
          <strong>R$ -{{ number_format($expense, 2, ',', '.') }}</strong>
        </div>
      </div>
      <div class="row col-md-3 offset-1 rounded align-items-center" style="background-color:Gainsboro;">
        <div class="h3 text-info col-md-3">
          <i class="fa fa-university" aria-hidden="true"></i>
        </div>
        <div class="h5 col-md-9">
          <strong>R$ 50.000,00</strong>
        </div>
      </div>
    </div>

    <div class="container container-fluid mt-4 row">
      <div class="col-sm-6">
        <table class="table table-striped">
          <thead>
            <th>Mês/Ano</th>
            <th>Receitas</th>
            <th>Despesas</th>
            <th>Saldo</th>
          </thead>
          <tbody>
            <td>teste2</td>
            <td>teste2</td>
            <td>teste2</td>
            <td>teste2</td>
          </tbody>
        </table>
      </div>


  </div>
@endsection