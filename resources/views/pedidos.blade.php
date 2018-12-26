{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('cliente_id', 'Cliente_id:') !!}
			{!! Form::text('cliente_id') !!}
		</li>
		<li>
			{!! Form::label('preco', 'Preco:') !!}
			{!! Form::text('preco') !!}
		</li>
		<li>
			{!! Form::label('desconto', 'Desconto:') !!}
			{!! Form::text('desconto') !!}
		</li>
		<li>
			{!! Form::label('pago', 'Pago:') !!}
			{!! Form::text('pago') !!}
		</li>
		<li>
			{!! Form::label('documento', 'Documento:') !!}
			{!! Form::text('documento') !!}
		</li>
		<li>
			{!! Form::label('pagamento_id', 'Pagamento_id:') !!}
			{!! Form::text('pagamento_id') !!}
		</li>
		<li>
			{!! Form::label('parcela_paga', 'Parcela_paga:') !!}
			{!! Form::text('parcela_paga') !!}
		</li>
		<li>
			{!! Form::label('parcela_total', 'Parcela_total:') !!}
			{!! Form::text('parcela_total') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}