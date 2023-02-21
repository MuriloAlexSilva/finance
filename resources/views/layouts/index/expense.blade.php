@extends('layouts.app')

@section('content')
  <div class="container container-fluid" style="margin-top:100px; width:70%">
    <div class="row">
      <div class="col-11">
        <h3>Despesas</h3>
      </div>
      <div class="col-1">
        <a href="{{route('revenue_type.create')}}" class="btn btn-outline">
          <i class="fa fa-plus fa-lg" style="color:green"></i>
        </a>
      </div>
    </div>
    <table class="table table-success nowrap responsive table-hover">
      <thead>
        <th>Data</th>
        <th>Tipo de Despesa</th>
        <th>Subtipo de Despesa</th>
        <th>É recorrente</th>
        <th>É parcelado</th>
        <th>Valor</th>
        <th>Descrição</th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($expenseList as $expense)
          <tr>
            <td>{{ \Carbon\Carbon::parse($expense->date)->format("d/m/Y") }}</td>
            <td>{{$expense->id_expense_type}}</td>
            <td>{{$expense->id_expense_sub_type}}</td>
            <td>{{$expense->is_recurrent == 1 ? "Sim" : "Não"}}</td>
            <td>{{$expense->is_installments == 1 ? "Sim" : "Não"}}</td>
            <td>{{$expense->value}}</td>
            <td>{{$expense->description}}</td>
            <td style="text-align:end" class="">
              @if($expense->deleted_at == null)
                <a href="{{route('expense.edit',$expense->id_expense)}}" class="btn btn-info">
                  <i class="fa fa-edit"></i>
                </a>
                <a href="#" class="btn btn-danger" onclick="deleteClick({{$expense->id_expense}})">
                  <i class="fa fa-trash"></i>
                </a>
                <form id="delete-form-{{$expense->id_expense}}" action="{{route('expense.destroy',$expense->id_expense)}}"
                      method="POST" style="display:none;">
                  @csrf
                  @method('DELETE')
                </form>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="d-flex justify-content-center">
      {{$expenseList->appends(request()->all())->links()}}
      <div class="d-flex align-items-center pl-3">
        Exibindo {{$expenseList->count()}}
        de {{$expenseList->total()}} registros
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    function deleteClick(id)
    {
      if(confirm("Você tem certeza que deseja realizar a inativação? "))
        document.getElementById('delete-form-'+ id).submit();
    }
  </script>
@endsection