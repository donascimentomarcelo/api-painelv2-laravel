<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	{!! Html::style('css/bootstrap.css') !!}
	{!! Html::style('css/style.css') !!}
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<title>title</title>

</head>
<body>
	<div class="container background" style="background-color: rgba(221, 221, 221, 0.09); padding-left: 5%;">
		<div class="row">
			<div class="col">
				<h4>E-mail de Contato</h4>
				<hr>
				<h4>Meu nome é {!!$name!!},</h4>
					<h5></h5>
				<h4>Meu e-mail é {!!$email!!}.</h4>
					<h5></h5>
				<h4>Gostaria de tratar com você sobre o seguinte assunto: {!!$subject!!}</h4>
					<h5></h5>
				<h4>Conteúdo: {!!$description!!}</h4>
					<h5></h5>
			</div>
		</div>
		<hr>
		{!! HTML::image('images/capinella_ou_beaujolais.png', 'a picture', array('style' => 'height: 50px; width: 50px;')) !!}
	</div>
</body>
</html>