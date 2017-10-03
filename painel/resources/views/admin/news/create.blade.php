@extends('app')

@section('content')

{!! Html::style('css/style.css') !!}
{!! Html::style('css/altered.css') !!}

<div class="container-fluid align-div-principal">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 align-div-button">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Crie News e envie para sua lista de E-mails</h4></div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					{!! Form::open(['route'=>'admin.painel.email.send', 'class'=>'form', 'files'=>true])!!}
					
					<div class="alert alert-warning alert-del-img">
					<strong>Informações Importantes.</strong><br>
						Ao enviar você irá registrar a publicação e logo após será enviado para todos os e-mails ativos na sua lista. <br>
					</div>

						{!! csrf_field() !!}

						@include('admin.news._form')

						<div class="form-group">
							<span class="btn btn-default btn-file">
								{!! Form::file('images[]', array('class'=>'custom-file-input')) !!}
								<span class="glyphicon glyphicon-folder-open"></span> Selecione uma imagem
							</span>
						</div>

						<div class="form-group">
						 	{!! Form::submit('Enviar', ['class'=>'btn btn-primary'])!!}
						</div>

					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection