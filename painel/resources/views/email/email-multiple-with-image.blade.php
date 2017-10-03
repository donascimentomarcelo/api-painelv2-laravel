<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	{!! Html::style('css/bootstrap.css') !!}
	{!! Html::style('css/style.css') !!}
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<title>title</title>
<style>
	
@media(max-width: 2560px)
{
	.container-all{
		background-color: rgba(221, 221, 221, 0.09); 
		padding-left: 5%;    
		width: 80%; 
		margin-left: auto; 
		margin-right: auto;
	}

	.sub-conteiner{
		width: 70%; 
		margin-right: auto; 
		margin-left: auto;
	}
	.image{
		width: 90%
	}

}
@media(max-width: 425px)
{
	.container-all{
		width: 100%; 
	}
	.sub-conteiner{
		width: 100%; 
	}
}

</style>
</head>
<body>
	<div class="container background" class="container-all">
		<div class="align" class="sub-conteiner">
			<div class="row">
				<div class="col">
					<h2 style="text-align: center;">{!!$title!!}</h2>
					<hr>
						<h5></h5>
						<h4> {!!$description!!}</h4>
						<br><br>
						<img src="{!!$way!!}{!!$original_filename!!}" alt="{!!$title!!}" class="image">
				</div>
			</div>
		</div>
		<hr>
		{!! HTML::image('images/capinella_ou_beaujolais.png', 'a picture', array('style' => 'height: 50px; width: 50px;')) !!}
	</div>
</body>
</html>