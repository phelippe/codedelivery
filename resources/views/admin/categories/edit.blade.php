@extends('app')

@section('content')
	<div class="container">
		<h3>Nova categoria</h3>

		@include('errors._check')

		{!! Form::model($category, ['route'=>['admin.categories.update', $category->id]]) !!}

		@include('admin.categories._form')

		<div class="form-group">
			{!! Form::submit('Atualizar categoria', ['class'=>'btn btn-primary']) !!}
		</div>

		{!! Form::close() !!}

	</div>
@endsection