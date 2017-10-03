@extends('app')

@section('content')
{!! Html::style('css/style.css') !!}
{!! Html::style('css/altered.css') !!}

{!! Html::script('js/angular/lib/loading-bar.js') !!}
{!! Html::style('js/angular/lib/loading-bar.css') !!}

{!! Html::script('js/angular/user/userCtrl.js') !!}
{!! Html::script('js/angular/user/userAPIService.js') !!}
{!! Html::script('js/angular/lib/pagination/simplePagination.js') !!}

<div class="container-fluid align-div-principal" ng-app="user">
	<div class="row" ng-controller="userCtrl">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Registro de usuário</h4></div>
				<div class="panel-body">

					<form name="searchById">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
								<label for="">Código do Usuário</label>
									<div class="input-group">
										<input type="number" class="form-control" min="0" ng-model="cod.id" ng-required="true">
										<span class="input-group-btn">
											<button class="btn btn-primary"  type="button" ng-click="edit(cod)" ng-disabled="searchById.$invalid">
												<span class="glyphicon glyphicon-search"></span>
											</button>
										</span>
									</div>
								</div> 
							</div>
						</div>
					</form>

					{!! Form::open(['class'=>'form', 'name'=>'form'])!!}
						{!! csrf_field() !!}
						
	
						<div class="form-group">
						    {!! Form::hidden('id', null, ['class' => 'form-control', 'ng-model'=>'user.id']) !!}
						</div>
						<div class="form-group">
						    {!! Form::label('Nome', 'Nome') !!}
						    {!! Form::text('name', null, ['class' => 'form-control', 'ng-model'=>'user.name', 'required', 'ng-required'=>'true']) !!}
						</div>
						<div class="form-group">
						    {!! Form::label('E-mail', 'E-mail') !!}
						    {!! Form::text('email', null, ['class' => 'form-control', 'ng-model'=>'user.email', 'required', 'ng-required'=>'true']) !!}
						</div>
						<div class="form-group">
						    {!! Form::label('Senha', 'Senha') !!}
						    {!! Form::password('password',array('class' => 'form-control', 'required', 'ng-model'=>'user.password', 'ng-required'=>'true')) !!}
						</div>
						<div class="form-group">
						    {!! Form::label('Confirma senha', 'Confirma senha') !!}
							{!! Form::password('confirmpassword',array('class' => 'form-control', 'required', 'ng-model'=>'user.confirmpassword', 'ng-required'=>'true')) !!}
						</div>
						<div class="form-group">
						{!! Form::button('Salvar', ['class'=>'btn btn-success', 'ng-click'=>'save(user)', 'ng-disabled'=>'form.$invalid'])!!}
						{!! Form::button('Limpar', ['class'=>'btn btn-info', 'ng-click'=>'clear()'])!!}
						</div>
						<div id="loading-bar-container"></div>
					{!! Form::close()!!}
					<div class="snackbar-container" data-snackbar="true" data-snackbar-duration="5000" data-snackbar-remove-delay="200"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	#loading-bar .bar {
		position: relative;
		background: #333;
		height: 7px;
	}
</style>
@endsection
