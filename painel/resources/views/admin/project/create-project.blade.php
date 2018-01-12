@extends('app')

@section('content')

{!! Html::style('css/style.css') !!}
{!! Html::style('css/altered.css') !!}

{!! Html::script('js/angular/lib/loading-bar.js') !!}
{!! Html::style('js/angular/lib/loading-bar.css') !!}

{!! Html::script('js/angular/lib/upload/ng-file-upload-shim.js') !!}
{!! Html::script('js/angular/lib/upload/ng-file-upload.js') !!}

{!! Html::script('js/angular/project/projectCtrl.js') !!}
{!! Html::script('js/angular/project/projectAPIService.js') !!}
{!! Html::script('js/angular/project/projectVerifyAPIService.js') !!}

<div class="container-fluid align-div-principal" ng-app="project">
	<div class="row" ng-controller="projectCtrl">
		<div class="col-md-8 col-md-offset-2 align-div-button">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Criar Projeto</h4></div>
				<div class="panel-body">

				<div class="row">
					<div class="col-md-4">
						<form name="searchById">
							<div class="form-group">
								<label for="">Código do Projeto</label>
								<div class="input-group">
									<input type="number" class="form-control" min="0" ng-model="cod.id" ng-required="true" ng-change='<% checkboxModel.findSpeed %>'>
									<span class="input-group-btn">
										<button class="btn btn-primary"  type="button" ng-click="edit(cod)" ng-disabled="searchById.$invalid">
											<span class="glyphicon glyphicon-search"></span>
										</button>
									</span>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-4">
						<label for="">Modo pesquisa rápida</label>
						<div class="input-group">
							<input type="checkbox" ng-model="checkboxModel.findSpeed" ng-true-value="findProjecChangeInput(cod)" ng-false-value="' '">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							{!! Form::label('Uploads do projeto', 'Uploads do projeto') !!}
							{!! Form::text('upload', null, ['class' => 'form-control', 'ng-model'=>'uploadLength']) !!}
						</div>
					</div>
				</div>
					{!! Form::open(['name'=>'ProjectForm','route'=>'admin.painel.create.project', 'class'=>'form', 'files'=>true])!!}
						{!! csrf_field() !!}
						<div class="row">
							<div class="col-md-4">

								{!! Form::hidden('id', null, ['class' => 'form-control', 'ng-model'=>'project.id']) !!}

								<div class="form-group">
									{!! Form::label('Nome', 'Nome') !!}
									{!! Form::text('name', null, ['class' => 'form-control', 'ng-model'=>'project.name']) !!}
								</div>
							</div>


							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('Categoria', 'Categoria') !!}
									{!! Form::text('category', null, ['class' => 'form-control', 'ng-model'=>'project.category']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('Link', 'Link') !!}
									{!! Form::text('link', null, ['class' => 'form-control', 'ng-model'=>'project.link']) !!}
								</div>
							</div>
						</div>

				<div class="form-group">
					{!! Form::label('Descrição', 'Descrição') !!}
					{!! Form::textarea('description', null, ['class' => 'form-control', 'ng-model'=>'project.description']) !!}
				</div>

				<div class="form-group">
					{!! Form::button('Salvar', ['class'=>'btn btn-primary', 'ng-disabled'=>'!(project.name && project.category && project.link && project.description)', 'ng-click'=>'save()'])!!}

					{!! Form::button('Limpar', ['class'=>'btn btn-info', 'ng-disabled'=>'!(project.name && project.category && project.link && project.description)', 'ng-click'=>'clear()'])!!}

					{!! Form::button('Excluir', ['class'=>'btn btn-danger', 'ng-disabled'=>'!(project.id && project.name && project.category && project.link && project.description)', 'ng-click'=>'deleteProject()'])!!}
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