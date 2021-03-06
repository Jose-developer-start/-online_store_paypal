@extends('layouts.app')

@section('content')
    <!-- boton flotante de whatsapp-->
<a class="float" href="https://api.whatsapp.com/send?phone=50371381006&text=Hola,%20bienvenidos%20a%20nuestro%20%20WhasatsApp,%20realiza%20tu%20consuta,%20te%20atenderemos%20rapidamente." target="_blank">
    <i class="fab fa-whatsapp my-float fa-1x">
    </i>
</a>
<!-- ceramos el  flotante de whatsapp-->
    <div class="container" style="margin-top: 60px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Tecnlogy BOX</a></li>
                <li class="breadcrumb-item active" aria-current="page">Carrito</li>
            </ol>
        </nav>
        @if(session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(count($errors) > 0)
            @foreach($errors0>all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <br>
                @if(\Cart::getTotalQuantity()>0)
                    <h4>{{ \Cart::getTotalQuantity()}} Producto(s) en tu carrito</h4><br>
                @else
                    <h4>No hay productos en el carrito</h4><br>
                    <a href="/productos" class="btn btn-dark">Continuar comprando</a>
                @endif

                @foreach($cartCollection as $item)
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="{{ asset('storage/'.$item->attributes->image) }}" class="img-thumbnail" width="200" height="200">
                        </div>
                        <div class="col-lg-5">
                            <p>
                                <b><a href="/shop/{{ $item->name }}">{{ $item->name }}</a></b><br>
                                <b>Descripción</b> {{ $item->attributes->details }} <br>
                                <b>Precio: </b>${{ $item->price }}<br>
                                <b>Sub Total: </b>${{ \Cart::get($item->id)->getPriceSum() }}<br>
                                {{--                                <b>With Discount: </b>${{ \Cart::get($item->id)->getPriceSumWithConditions() }}--}}
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row " style="margin-left: 15px">
                                        <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                        <input type="number" min="1" class="form-control form-control-sm update-card" value="{{ $item->quantity }}"
                                               id="quantity" name="quantity" style="width: 70px; margin-right: 10px;">
                                        <button data-container="body" data-toggle="popover" data-placement="bottom" data-content="Actualizar producto" class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i class="fa fa-edit"></i></button>
                                    </div>
                                </form>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                    <button class="btn btn-dark btn-sm" style="margin-right: 10px;"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if(count($cartCollection)>0)
                    <form action="{{ route('cart.clear') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-secondary btn-md">Vaciar carrito</button>
                    </form>
                @endif
            </div>
            @if(count($cartCollection)>0)
                <div class="col-lg-5">
                    <div class="card my-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Total a pagar: </b>${{ \Cart::getTotal() }}</li>
                        </ul>
                    </div>
                    <div class="d-flex-md justify-content-between">
                        <a href="{{ route('main.productos') }}" class="btn btn-dark mr-2">Continuar comprando</a>
                        <a href="/checkout" class="btn btn-success">Proceder a pagar</a>
                    </div>
                </div>
            @endif
        </div>
        <br><br>
    </div>
@endsection