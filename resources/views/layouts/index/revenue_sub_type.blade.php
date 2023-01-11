@extends('layouts.app')

@section('content')
  <div class="container container-fluid" style="margin-top:100px; width:70%">
    <div class="row">
      <div class="col-11">
        <h3>Subtipos de Receitas</h3>
      </div>
      <div class="col-1">
        <a href="{{route('revenue_sub_type.create')}}" class="btn">
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
        @foreach ($revenueSubTypeList as $revenueSubType)
          <tr>
            <td>{{$revenueSubType->name}}</td>
            <td style="text-align:end" class="">
              @if($revenueSubType->deleted_at == null)
                <a href="{{route('revenue_sub_type.edit',$revenueSubType->id_revenue_sub_type)}}" class="btn btn-info">
                  <i class="fa fa-edit"></i>
                </a>
                <a href="#" class="btn btn-danger" onclick="deleteClick({{$revenueSubType->id_revenue_sub_type}})">
                  <i class="fa fa-trash"></i>
                </a>
                <form id="delete-form-{{$revenueSubType->id_revenue_sub_type}}" action="{{route('revenue_sub_type.destroy',$revenueSubType->id_revenue_sub_type)}}"
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
      {{$revenueSubTypeList->appends(request()->all())->links()}}
      <div class="d-flex align-items-center" style="padding-left:10px; ">
        Exibindo {{$revenueSubTypeList->count()}}
        de {{$revenueSubTypeList->total()}} registros
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