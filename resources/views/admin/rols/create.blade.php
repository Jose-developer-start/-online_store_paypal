@extends('admin.layout')

@section('title','Usuario/Agregar')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Roles</h1>
      <p>Agrega un nuevo rol al sistema</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Role</li>
      <li class="breadcrumb-item active"><a href="#">Agregar</a></li>
    </ul>
  </div>
  @include('admin.partials.notify')
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <form action="{{ route('rol.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @include('admin.rols._form')
          <div class="tile-footer">
            <button class="btn btn-primary" type="submit">Agregar</button>
            <a href="{{ route('rol.index') }}" class="btn btn-outline-danger">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection
    