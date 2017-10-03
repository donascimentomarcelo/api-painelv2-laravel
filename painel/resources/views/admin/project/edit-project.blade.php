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

<div class="container-fluid align-div-principal" ng-app="project" >
	<div class="row" ng-controller="projectCtrl">
		<div class="col-md-8 col-md-offset-2 align-div-button">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Gerenciar Imagens do Projeto</h4></div>
				<div class="panel-body">
				<!-- BUSCAR PELO ID DO PROJETO -->
					<form name="searchById">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
								<label for="">Código do Projeto</label>
									<div class="input-group">
										<input type="number" class="form-control" min="0" ng-model="cod.id" ng-required="true" ng-change="findProjecChangeInput(cod)">
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
					<!-- BUSCAR PELO ID DO PROJETO -->
					
					<!-- FORMULARIO DE ADICIONAR IMAGEM -->
					<div class="row">
						<div class="panel-heading">
							<h4> Inserir Imagens</h4>
						</div>
						<form name="addImgForm">
							<input type="hidden" ng-model="project.id">
							<div class="col-md-4">
								<div class="form-group">
									<span class="btn btn-default btn-file">
										<input type="file" ngf-select ng-model="project.file" name="file"    
										accept="image/*" ngf-max-size="2MB"  multiple
										ngf-model-invalid="errorFile">
										<span class="glyphicon glyphicon-folder-open"></span> Selecione imagens
									</span>
								</div>
								<div class="form-group">
									<button class="btn btn-info" ng-click="addImage()">
										<span class="glyphicon glyphicon-plus"></span> Adicione as imagens
									</button>
								</div>
							</div>
						</form>
					</div>
					<!-- FORMULARIO DE ADICIONAR IMAGEM -->

					<!-- lISTAR IMAGENS DO PROJETO -->
					<div class="panel panel-default" ng-show="project.upload.data.length > 0">
						<div class="panel-heading">
							<h4> Imagens do projeto </h4>
						</div>
						<div class="form-group">
							<div class="row">
								<div ng-repeat="p in project.upload.data" class="col-md-4">
									<form name="imageForm" enctype="multipart/form-data">
										<div class="panel panel-default" ng-show="project.upload.data">
											<div class="panel-heading">
												<h5>Código da imagem - # <% p.id %></h5>	
											</div>
											<img data-ng-src="<% p.way + p.original_filename %>" class="img-project-list img-thumbnail">
											<div class="btn-group btn-group-justified" role="group" aria-label="...">
												<div class="btn-group" role="group">
													<button class="btn btn-success btn-sm btn-block" ng-click="fillImage(p)">
														<span class="glyphicon glyphicon-ok"></span>
													</button>
												</div>
												<div class="btn-group" role="group">
													<button class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#confirmDeleteImage">
														<span class="glyphicon glyphicon-trash"></span>
													</button>
												</div>
											</div>
										</div>
									</form>
									<!-- CONFIRM DELETE-->
									<div id="confirmDeleteImage" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Deseja realmente excluir essa imagem?</h4>
												</div>
												<div class="modal-body">
													<p>Ao excluir a imagem a mesma não poderá ser recuperada.</p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

													<button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="deleteImage(p)">Confirmar</button>
												</div>
											</div>
										</div>
									</div>
									<!-- CONFIRM DELETE-->
								</div>
							</div>
						</div>
					</div>
					<!-- lISTAR IMAGENS DO PROJETO -->
					<!-- BUSCAR PELO CÓDIGO DA IMAGEM -->
					<form name="searchImageById">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
								<label for="">Código da Imagem</label>
									<div class="input-group">
										<input type="number" class="form-control" min="0" ng-model="codImg.id" ng-required="true">
										<span class="input-group-btn">
											<button class="btn btn-primary"  type="button" ng-click="editImage(codImg)" ng-disabled="searchImageById.$invalid">
												<span class="glyphicon glyphicon-search"></span>
											</button>
										</span>
									</div>
								</div> 
							</div>
						</div>
					</form>
					<div>
					<!-- BUSCAR PELO CÓDIGO DA IMAGEM -->
					<!-- ALTERAR IMAGEM -->
					{!! Form::open(['files'=>true])!!}
						<input type="hidden" class="form-control" ng-model="codImg.id">

						<div class="align-image" ng-show="img">
							<label for="">Imagem do projeto</label>
							<div class="form-group">
								<img data-ng-src="<% img.way + img.original_filename %>" class="img-project-edit img-thumbnail">
							</div>
						</div>

						<div class="form-group">
							<label for="order">Ordem da imagem</label>
							<input type="number" id="order" name="order" class="form-control" ng-model="img.order">
						</div>

						<div class="form-group">
							<span class="btn btn-default btn-file">
								<input type="file" ngf-select ng-model="img.file" name="file"    
								accept="image/*" ngf-max-size="2MB"  multiple
								ngf-model-invalid="errorFile">
								<span class="glyphicon glyphicon-folder-open"></span> Selecione as imagens
							</span>
						</div>
						
						<div class="form-group">
							{!! Form::button('Salvar Alteração', ['class'=>'btn btn-primary', 'ng-click'=>'updateImage()'])!!}

							{!! Form::button('Limpar', ['class'=>'btn btn-info', 'ng-click'=>'clearImage()'])!!}
						</div>

						{!! Form::close()!!}
						<!-- ALTERAR IMAGEM -->
					</div>		    
					<div id="loading-bar-container"></div>
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
	.align-div-button{
		margin-bottom: 5%;
	}
</style>
@endsection