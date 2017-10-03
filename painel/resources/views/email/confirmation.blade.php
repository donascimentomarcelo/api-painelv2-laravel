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
	<div class="container background" style="background-color: rgba(221, 221, 221, 0.09); padding-left: 5%;    width: 60%; margin-left: auto; margin-right: auto;">
		<div class="row">
			<div class="col">
				<h2 style="text-align: center;">E-mail de confirmação.</h2>
				<hr>
					<h5>Olá {!!$name!!},</h5>
					<h5>Esse e-mail é para confirmação da inscrição do email <b> {!!$email!!} </b> no site  <b> marceloprogrammer.com </b> para receber novidades.</h5>
					
						<a href="http://marceloprogrammer.com/api/emails/update/{!!$id!!}/confirmation">
						Clique nesse link para realizar a confirmação da inscrição.
						</a>
						

			</div>
		</div>
		<hr>
		{!! HTML::image('images/capinella_ou_beaujolais.png', 'a picture', array('style' => 'height: 50px; width: 50px;')) !!}
	</div>
</body>
</html>