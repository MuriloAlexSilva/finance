@extends('layouts.app')

@section('content')
  <div class="container container-fluid">
    <div class="row">
      <div class="col-11">
        <h3>Tipos de Recebimentos</h3>
      </div>
      <div class="col-1">
        <a href="{{route('revenue_type.create')}}" class="btn">
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
        @foreach ($revenueTypeList as $revenueType)
          <tr>
            <td>{{$revenueType->name}}</td>
            <td style="text-align:end" class="">
              @if($revenueType->deleted_at == null)
                <a href="{{route('revenue_type.edit',$revenueType->id_revenue_type)}}" class="btn btn-info">
                  <i class="fa fa-edit"></i>
                </a>
                <a href="#" class="btn btn-danger" onclick="deleteClick({{$revenueType->id_revenue_type}})">
                  <i class="fa fa-trash"></i>
                </a>
                <form id="delete-form-{{$revenueType->id_revenue_type}}" action="{{route('revenue_type.destroy',$revenueType->id_revenue_type)}}"
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
      {{$revenueTypeList->appends(request()->all())->links()}}
      <div class="d-flex align-items-center" style="padding-left:10px; ">
        Exibindo {{$revenueTypeList->count()}}
        de {{$revenueTypeList->total()}} registros
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