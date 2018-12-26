{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('pedido_id', 'Pedido_id:') !!}
			{!! Form::text('pedido_id') !!}
		</li>
		<li>
			{!! Form::label('produto', 'Produto:') !!}
			{!! Form::text('produto') !!}
		</li>
		<li>
			{!! Form::label('quantidade', 'Quantidade:') !!}
			{!! Form::text('quantidade') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}