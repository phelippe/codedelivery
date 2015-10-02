@extends('app')

@section('content')
    <div class="container">
        <h3>Pedidos</h3>
        <br>
        {{--<a href="{{ route('admin.orders.create') }}" class="btn btn-default">Novo pedido</a>--}}

        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td>Cliente:</td>
                    <td>R$ {{$client->name}}</td>
                </tr>
                <tr>
                    <td>Cliente e-mail:</td>
                    <td>R$ {{$client->email}}</td>
                </tr>
                <tr>
                    <td>Total:</td>
                    <td>R$ {{$order->total}}</td>
                </tr>
                <tr>
                    <td>Estado:</td>
                    <td>{{$order->status}}</td>
                </tr>
                <tr>
                    <td>Data:</td>
                    <td>{{$order->created_at}}</td>
                </tr>
                <tr>
                    <td>Entregador:</td>
                    <td>{{$deliveryman->name}}</td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Valor (R$)</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->product->name}}</td>
                    <td>{{$product->product->price}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection