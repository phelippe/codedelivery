@extends('app')

@section('content')
	<div class="container">
		<h3>Pedidos</h3>
		<br>
		{{--<a href="{{ route('admin.orders.create') }}" class="btn btn-default">Novo pedido</a>--}}

		<table class="table table-bordered">
			<thead>
			<tr>
				<th>ID</th>
				<th>Cliente</th>
				<th>Entregador</th>
				<th>Total (R$)</th>
				<th>Status</th>
				<th>Ações</th>
			</tr>
			</thead>
			<tbody>
			@foreach($orders as $order)
			<tr>
				<td>{{$order->id}}</td>
				<td>{{$order->client['id']}}</td>
				<td>{{$order->deliveryman['id']}}</td>
				<td>R$ {{$order->total}}</td>
				<td>{{$order->status}}</td>
				<td>
					<a href="{{route('admin.orders.show', ['id'=>$order->id])}}" class="btn btn-default btn-sm">Itens</a>
					<a href="{{route('admin.orders.edit', ['id'=>$order->id])}}" class="btn btn-default btn-sm">Editar</a>
				</td>
			</tr>
			@endforeach
			</tbody>
		</table>

	</div>
@endsection