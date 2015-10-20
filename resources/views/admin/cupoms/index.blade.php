@extends('app')

@section('content')
	<div class="container">
		<h3>Pedidos</h3>
		<br>
		<a href="{{ route('admin.cupoms.create') }}" class="btn btn-default">Novo cupom</a>

		<table class="table table-bcupomed">
			<thead>
			<tr>
				<th>ID</th>
				<th>Código</th>
				<th>Valor</th>
				<th>Criado em</th>
				<th>Ações</th>
			</tr>
			</thead>
			<tbody>
			@foreach($cupoms as $cupom)
			<tr>
				<td>#{{$cupom->id}}</td>
				<td> {{$cupom->code}}</td>
				<td> {{$cupom->value}}</td>
				<td> {{$cupom->created_at}}</td>
				<td>
					<a href="{{route('admin.cupoms.show', ['id'=>$cupom->id])}}" class="btn btn-default btn-sm">Ver</a>
					<a href="{{route('admin.cupoms.edit', ['id'=>$cupom->id])}}" class="btn btn-default btn-sm">Editar</a>
				</td>
			</tr>
			@endforeach
			</tbody>
		</table>
		{!! $cupoms->render() !!}
	</div>
@endsection