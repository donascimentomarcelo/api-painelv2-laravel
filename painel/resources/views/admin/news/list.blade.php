@extends('app')

@section('content')

{!! Html::style('css/style.css') !!}
{!! Html::style('css/altered.css') !!}

<div class="container-fluid align-div-principal">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 align-div-button">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Lista de publicações</h4></div>
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
					<table class="table" style="text-align: center;">
						<thead>
							<tr>
								<th style="text-align: center;">ID</th>
								<th style="text-align: center;">Título</th>
								<th style="text-align: center;">Assunto</th>
								<th style="text-align: center;">Editar e Enviar</th>
							</tr>
							<tbody>
								@foreach($news as $new)
								<tr>
									<td>{{$new->id}}</td>
									<td>{{$new->title}}</td>
									<td>{{$new->subject}}</td>
									<td>
										<a href="{{route('admin.painel.news.edit',['id'=>$new->id])}}" class="btn btn-success btn-sm">
											<span class="glyphicon glyphicon-pencil"></span>
											
											<span class="glyphicon glyphicon-send"></span>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</thead>
					</table>
					{!! $news->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
