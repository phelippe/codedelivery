@extends('app')

@section('content')
	<div class="container">
		<h2>Editando pedido: #{{$order->id}} - R$ {{$order->total}}</h2>
		<h3>Cliente: {{ $order->client->user->name }}</h3>
		<h4>data: {{ $order->created_at}}</h4>
		<p>
			<b>Entregar em:</b><br/>
			{{$order->client->address}} - {{$order->client->city}} - {{$order->client->state}}
		</p>

		@include('errors._check')

		{!! Form::model($order, ['route'=>['admin.orders.update', $order->id]]) !!}

		@include('admin.orders._form')

		<div class="form-group">
			{!! Form::submit('Atualizar pedido', ['class'=>'btn btn-primary']) !!}
		</div>

		{!! Form::close() !!}

	</div>
@endsection