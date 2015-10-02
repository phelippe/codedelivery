<div class="form-group">
	{!! Form::label('user_deliveryman_id', 'Entregador: ') !!}
	{!! Form::select('user_deliveryman_id', $deliverymen, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('status', 'Estado: ') !!}
	{!! Form::text('status', null, ['class'=>'form-control']) !!}
</div>
