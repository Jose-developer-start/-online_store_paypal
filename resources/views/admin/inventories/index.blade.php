@extends('admin.layout')

@section('title','Productos')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Inventario/s</h1>
      <p>Admistración de productos</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Inventario</li>
      <li class="breadcrumb-item active"><a href="#">datos</a></li>
    </ul>
  </div>
  @include('admin.partials.notify')
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre productos</th>
                  <th>Cantidad disponible</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                
                @foreach ($inventories as $inventario)
                <tr>
                  <td>{{ $inventario->id }}</td>
                  <td>
                      @foreach ($inventario->products as $product)    
                      {{ $product->name }}
                      @endforeach  
                  </td>
                  <td>{{ $inventario->stock }}</td>
                  <td>@if ($inventario->status == 1)
                      Activo
                      @else
                      Desactivado
                      @endif
                  </td>
                  <td>
                      <div class="d-flex justify-content-end">
                        <a href="{{ route('inventario.edit',$inventario) }}" class="btn btn-outline-info btn-sm mb-2 mx-4">Editar</a>
                      
                      </div>
                  </td>
                </tr> 
                @endforeach
              </tbody>
            </table>
            {{ $inventories->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
    