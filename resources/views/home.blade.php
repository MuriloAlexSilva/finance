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
      <div class="row col-md-3 rounded align-items-center" style="background-color:rgba(75, 192, 192,0.4)">
        <div class="h3 text-success col-md-3">
          <i class="fa fa-arrow-down" aria-hidden="true"></i>
        </div>
        <div class="h5 col-md-9">
          <strong>R$ {{ number_format($revenue, 2, ',', '.') }}</strong>
        </div>
      </div>
      <div class="row col-md-3 align-items-center offset-1 rounded" style="background-color:rgba(255, 99, 132, 0.2)">
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
    <div class="row">
      <div class="mt-4 mr-4 col-sm-6">
        <center>
          <canvas id="revenue" class="h-100 w-75"></canvas>
        </center>
      </div>
      <div class="mt-4 mr-4 col-sm-6">
        <center>
          <canvas id="expense" class="h-100 w-75"></canvas>
        </center>
      </div>
    </div>

    <div class="container container-fluid mt-4 row">
      <div class="col-sm-6">
        <table class="table table-striped">
          <thead>
            <tr>
              <th colspan="2">Receitas</th>
            </tr>
            <tr>
              <th>Mês/Ano</th>
              <th>Valor</th>
            </tr>
          </thead>
          <tbody>
            @if($list['Revenue'] > 0)
              @foreach ($list['Revenue'] as $key => $value)  
                <tr>
                  <td>{{$key}}</td>
                  <td>R$ {{ number_format($value, 2, ',', '.') }}</td>
                </tr>
              @endforeach
            @else
              <tr>
                <td>Não possui lançamentos</td>
                <td></td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
      <div class="col-sm-6">
        <table class="table table-striped">
          <thead>
            <tr>
              <th colspan="2">Despesas</th>
            </tr>
            <tr>
              <th>Mês/Ano</th>
              <th>Valor</th>
            </tr>
          </thead>
          <tbody>
            @if($list['Expense'] != 0)<!-- Tem que criar a validaçao de quando nao tem o resultado   -->
              @foreach ($list['Expense'] as $key => $value)  
                <tr>
                  <td>{{$key}}</td>
                  <td>R$ {{ number_format($value, 2, ',', '.') }}</td>
                </tr>
              @endforeach
            @else
              <tr>
                <td>Não possui lançamentos</td>
                <td></td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <br><br><br><br><br><br>
@endsection
{{-- @dd() --}}
@section('scripts')
  <script>
    var revenueId    = document.getElementById("revenue");
    var expenseId    = document.getElementById("expense");
    var revenueType  = JSON.parse(`<?php echo json_encode(array_keys($list['Revenue'])); ?>`);
    var revenueValue = JSON.parse(`<?php echo json_encode(array_values($list['Revenue'])); ?>`);
    var expenseType  = JSON.parse(`<?php echo json_encode(array_keys($list['Expense'])); ?>`);
    var expenseValue = JSON.parse(`<?php echo json_encode(array_values($list['Expense'])); ?>`);
    var chartRevenue = charts(revenueId,'bar',revenueType,'Receitas',revenueValue);
    var chartExpense = charts(expenseId,'bar',expenseType,'Despesas',expenseValue);
    

    function charts(id,type,labels,label,data)
    {
      new Chart(id,{
        type: type,
        data:{
          labels:labels,
          datasets:[{
            label:label,
            data:data,
            backgroundColor:[
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
            ],
            borderColor:[
              'rgb(255, 99, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(201, 203, 207)'
            ]
          }]
        },
        options:{
          legend:{display:true},
          scales:{
            beginAtZero:true,
          }
        }
      });
    }

  </script>
  @endsection