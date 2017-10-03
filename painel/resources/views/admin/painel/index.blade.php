@extends('app')

@section('content')

{!! Html::style('css/style.css') !!}
{!! Html::style('css/altered.css') !!}


<div class="container-fluid align-div-principal" >
	<div class="row">
		<div class="col-md-8 col-md-offset-2 align-div-button">
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align: center;"><h4>{{ auth()->user()->name }}, bem vindo ao Painel!!!</h4></div>

				<div class="panel-body">
					Criar aqui um painel com informações do usuário, de configs do painel, do site...<br>
					ex: <br>
					ftp: www.marcelo.com <br>
					email cadastrados: 10 ...
				</div>
			</div>
		</div>
	</div>
</div>
@endsection