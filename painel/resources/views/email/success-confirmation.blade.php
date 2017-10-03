<!DOCTYPE html>
<html lang="en">
<head>
@extends('app')
@section('content')
	<meta charset="UTF-8">
	{!! Html::style('css/bootstrap.css') !!}
	{!! Html::style('css/style.css') !!}
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<title>Sucesso no cadastro de e-mail</title>

</head>
<body>
	<div class="container background" style="background-color: rgba(221, 221, 221, 0.09); padding-left: 5%;    width: 60%; margin-left: auto; margin-right: auto;">
		<div class="row">
			<div class="col">
				<h2 style="text-align: center;">Obrigado por se cadastrar!</h2>
				<hr>
					<div  style="text-align: center;">
						<h4>
						<br><br>
							Seu e-mail foi cadastrado com sucesso! <br><br>
							Em breve você receberá nossas novidades. <br><br>
							<a href="http://marceloprogrammer.com" class="btn btn-info">Retornar ao Site <span class="glyphicon glyphicon-ok"></span> </a>
						</h4>
					</div>

			</div>
		</div>
		<hr>
		{!! HTML::image('images/capinella_ou_beaujolais.png', 'a picture', array('style' => 'height: 50px; width: 50px;')) !!}
	</div>
</body>
</html>

@endsection