@extends('app')

@section('content')

{!! Html::style('css/style.css') !!}
{!! Html::style('css/altered.css') !!}

<div class="container-fluid align-div-principal">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 align-div-button">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Lista de E-mails</h4></div>
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
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>E-mail</th>
								<th>Status</th>
							</tr>
							<tbody>
								@foreach($emails as $email)
								<tr>
									<td>{{$email->id}}</td>
									<td>{{$email->email}}</td>
									<td>{{$email->status}}</td>
								</tr>
								@endforeach
							</tbody>
						</thead>
					</table>
					{!! $emails->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
