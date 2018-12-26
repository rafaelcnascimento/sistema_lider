{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('nome', 'Nome:') !!}
			{!! Form::text('nome') !!}
		</li>
		<li>
			{!! Form::label('telefone', 'Telefone:') !!}
			{!! Form::text('telefone') !!}
		</li>
		<li>
			{!! Form::label('celular', 'Celular:') !!}
			{!! Form::text('celular') !!}
		</li>
		<li>
			{!! Form::label('documento', 'Documento:') !!}
			{!! Form::text('documento') !!}
		</li>
		<li>
			{!! Form::label('endereco', 'Endereco:') !!}
			{!! Form::text('endereco') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}