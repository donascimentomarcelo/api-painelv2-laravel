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
	<div class="container background" style="background-color: rgba(221, 221, 221, 0.09); padding-left: 5%;    width: 80%; margin-left: auto; margin-right: auto;">
		<div class="align" style="width: 90%; margin-right: auto; margin-left: auto;">
			<div class="row">
				<div class="col">
					<h2 style="text-align: center;">{!!$title!!}</h2>
					<hr>
					<h5></h5>
					<h4> {!!$description!!}</h4>
					<h5></h5>
				</div>
			</div>
		</div>
		<hr>
		{!! HTML::image('images/capinella_ou_beaujolais.png', 'a picture', array('style' => 'height: 50px; width: 50px;')) !!}
	</div>
</body>
</html>