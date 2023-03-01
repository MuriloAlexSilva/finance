@extends('layouts.app')

@section('content')
  <div class="container container-fluid" style="margin-top:100px; width:70%">
    <div class="row">
      <div class="col-11">
        @if(isset($item))
          <h3>Editando Tipos de Receitas</h3>
        @else
          <h3>Cadastro de Tipos de Receitas</h3>
        @endif
      </div>
      <div class="">
        <a href="{{route('revenue_type.index')}}" class="btn btn-danger">
          <i class="fa fa-arrow-left "></i>
        </a>
      </div>
    </div>
    <div class="pt-5">
      @if(isset($item))
        <form action="{{route('revenue_type.update',$item->id_revenue_type)}}" method="POST">
          @method('PUT')
      @else
        <form action="{{route('revenue_type.store')}}" method="POST">
      @endif  
        @csrf

        <div class="justify-content-center align-items-center form-group row">
          <label class="col-md-1 col-form-label" style="font-size:large">{{__('Nome:')}}</label>
          <div class="col-md-4">
            <input id="name" class="form-control" type="text" name="name" value="{{isset($item) && $item != null ? $item->name : ""}}">
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