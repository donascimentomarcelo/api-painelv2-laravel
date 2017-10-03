@extends('app')

@section('content')

{!! Html::style('css/style.css') !!}
{!! Html::style('css/altered.css') !!}

{!! Html::script('js/angular/lib/loading-bar.js') !!}
{!! Html::style('js/angular/lib/loading-bar.css') !!}

{!! Html::script('js/angular/lib/upload/ng-file-upload-shim.js') !!}
{!! Html::script('js/angular/lib/upload/ng-file-upload.js') !!}

{!! Html::script('js/angular/promotion/promotionCtrl.js') !!}
{!! Html::script('js/angular/promotion/promotionAPIService.js') !!}

{!! Html::script('js/angular/lib/date/angular-input-date.js') !!}


<div class="container-fluid align-div-principal" ng-app='promotion'>
	<div class="row" ng-controller='promotionCtrl'>
		<div class="col-md-8 col-md-offset-2 align-div-button">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Criar Promoções</h4></div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
						<form name="searchById">
								<div class="form-group">
									<div class="row">
										<div class="col-md-12">
										<label for="">Código da Promoção</label>
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
						</div>
					</div>
					{!! Form::open(['name'=>'form','route'=>'admin.painel.promotions.create', 'class'=>'form', 'files'=>true])!!}
						{!! csrf_field() !!}
							<div class="form-group">
								{!! Form::hidden('id', null, ['class' => 'form-control', 'ng-model'=>'promotion.id']) !!}
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										{!! Form::label('Nome', 'Nome') !!}
										{!! Form::text('name', null, ['class' => 'form-control', 'ng-model'=>'promotion.name']) !!}
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										{!! Form::label('Título', 'Título') !!}
										{!! Form::text('title', null, ['class' => 'form-control', 'ng-model'=>'promotion.title']) !!}
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										{!! Form::label('Status', 'Status') !!}
										{!! Form::text('status', null, ['class' => 'form-control', 'ng-model'=>'promotion.status']) !!}
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">		 
									<div class="form-group">
										<label for="date-birth" class="control-label">Data de criação:</label>
										<div class="control">
											<input class="form-control" type="text" ng-model="getDate" disabled="true">
										</div>
									</div>
								</div>
								<div class="col-md-4">		 
									<div class="form-group">
										<label for="date-birth" class="control-label">Data de início:</label>
										<div class="control">
											<input id="date-birth" class="form-control" type="date" ng-model="promotion.dt_start">
										</div>
									</div>
								</div>
								<div class="col-md-4">		 
									<div class="form-group">
										<label for="date-birth" class="control-label">Data do fim:</label>
										<div class="control">
											<input id="date-birth" class="form-control" type="date" ng-model="promotion.dt_end">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">	
									<div class="form-group">
										{!! Form::label('Descrição', 'Descrição') !!}
										{!! Form::textarea('description', null, ['class' => 'form-control', 'ng-model'=>'promotion.description']) !!}
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="date-birth" class="control-label">Selecione uma imagem</label>
										<div class="control">
											<span class="btn btn-default btn-file">
												<input type="file" ngf-select ng-model="promotion.file" name="file"    
												accept="image/*" ngf-max-size="2MB"
												ngf-model-invalid="errorFile">
												<span class="glyphicon glyphicon-folder-open"></span> 
											</span>
										</div>
									</div>
								</div>
							</div>

						
						<div class="form-group">
						{!! Form::submit('Salvar', ['class'=>'btn btn-primary', 'ng-click'=>'save()'])!!}
						
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