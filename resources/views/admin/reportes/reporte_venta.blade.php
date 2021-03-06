@extends('admin.layout')

@section('title','Ventas')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="far fa-file"></i> Reportes</h1>
      <p>Reportes</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
     <li class="breadcrumb-item"> <a href="/mystore" title=""> <i class="fa fa-home fa-lg"></i></a></li>

      <li class="breadcrumb-item active"><a href="{{ route('sales.sales_index') }}">Ventas</a></li>
    </ul>
  </div>
  @include('admin.partials.notify')
  <div class="row">
    <div class="col-md-12">

 <form action="{{ route('reportes.store') }}" method="POST">
                        @csrf
                   <div class="d-flex mb-3 align-item-center">
               <input class="form-control w-25 " type="date" name="from"  value="">
          <input class="form-control w-25  mx-2" type="date" name="to" value="">
             <button type="submit" class="btn btn-outline-info btn-mb ">Filtrar</button>

                        </div>

                </form>


      <div class="tile">

        <div class="tile-body">
          <div class="table-responsive">
        @php
            $index = 0;

        @endphp
      <table class="table table-striped" id="table_rep">
            <thead class="">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Fecha.</th>
                <th scope="col">Descuento</th>
                <th scope="col">Nombre</th>
                <th scope="col">Cliente </th>
            </thead>
            <tbody>
                @foreach ($dataventa as $sale)
                    
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td> ${{ $sale->unit_price }}</td>
                    <td>{{ $sale->quanty}}</td>
                    <td>{{ $sale->date }}</td>
                    <td>{{ $sale->discount }}</td>
                    <td>{{ $sale->name }}</td>
                      <td>{{ $sale->name_user." ".$sale->surname }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
                  </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection