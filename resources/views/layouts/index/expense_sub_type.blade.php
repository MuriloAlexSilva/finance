@extends('layouts.app')

@section('content')
  <div class="container container-fluid" style="margin-top:100px; width:70%">
    <div class="row">
      <div class="col-11">
        <h3>Subtipo de Despesas</h3>
      </div>
      <div class="col-1">
        <a href="{{route('expense_sub_type.create')}}" class="btn">
          <i class="fa fa-plus-square fa-2x"></i>
        </a>
      </div>
    </div>
    <table class="table table-dark table-responsive table-hover">
      <thead>
        <th>Nome</th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($expenseSubTypeList as $expenseSubType)
          <tr>
            <td>{{$expenseSubType->name}}</td>
            <td style="text-align:end" class="">
              @if($expenseSubType->deleted_at == null)
                <a href="{{route('expense_sub_type.edit',$expenseSubType->id_expense_sub_type)}}" class="btn btn-info">
                  <i class="fa fa-edit"></i>
                </a>
                <a href="#" class="btn btn-danger" onclick="deleteClick({{$expenseSubType->id_expense_sub_type}})">
                  <i class="fa fa-trash"></i>
                </a>
                <form id="delete-form-{{$expenseSubType->id_expense_sub_type}}" action="{{route('expense_sub_type.destroy',$expenseSubType->id_expense_sub_type)}}"
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
      {{$expenseSubTypeList->appends(request()->all())->links()}}
      <div class="d-flex align-items-center" style="padding-left:10px; ">
        Exibindo {{$expenseSubTypeList->count()}}
        de {{$expenseSubTypeList->total()}} registros
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