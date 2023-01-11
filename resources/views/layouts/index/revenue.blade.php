@extends('layouts.app')

@section('content')
  <div class="container container-fluid" style="margin-top:100px; width:70%">
    <div class="row">
      <div class="col-11">
        <h3>Receitas</h3>
      </div>
      <div class="col-1">
        <a href="{{route('revenue.create')}}" class="btn">
          <i class="fa fa-plus-square fa-2x"></i>
        </a>
      </div>
    </div>
    <table class="table table-dark table-responsive table-hover">
      <thead>
        <th>Data</th>
        <th>Tipo de Receita</th>
        <th>SubTipo de Receita</th>
        <th>É recorrente</th>
        <th>Valor</th>
        <th>Descrição</th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($revenueList as $revenue)
          <tr>
            <td>{{ \Carbon\Carbon::parse($revenue->date)->format("d/m/Y") }}</td>
            <td>{{$revenue->id_revenue_type}}</td>
            <td>{{$revenue->id_revenue_sub_type}}</td>
            <td>{{$revenue->is_recurrent == 1 ? "Sim" : "Não"}}</td>
            <td>{{$revenue->value}}</td>
            <td>{{$revenue->description}}</td>
            <td style="text-align:end" class="">
              @if($revenue->deleted_at == null)
                <a href="{{route('revenue.edit',$revenue->id_revenue)}}" class="btn btn-info">
                  <i class="fa fa-edit"></i>
                </a>
                <a href="#" class="btn btn-danger" onclick="deleteClick({{$revenue->id_revenue}})">
                  <i class="fa fa-trash"></i>
                </a>
                <form id="delete-form-{{$revenue->id_revenue}}" action="{{route('revenue.destroy',$revenue->id_revenue)}}"
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
      {{$revenueList->appends(request()->all())->links()}}
      <div class="d-flex align-items-center" style="padding-left:10px; ">
        Exibindo {{$revenueList->count()}}
        de {{$revenueList->total()}} registros
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