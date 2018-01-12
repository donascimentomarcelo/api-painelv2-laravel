@extends('app')

@section('content')

{!! Html::style('css/style.css') !!}
{!! Html::style('css/altered.css') !!}

{!! Html::script('js/angular/lib/loading-bar.js') !!}
{!! Html::style('js/angular/lib/loading-bar.css') !!}

{!! Html::script('js/angular/lib/datetimepicker/moment.js') !!}

{!! Html::script('js/angular/lib/datetimepicker/bootstrap-datetimepicker.min.js') !!}
{!! Html::style('js/angular/lib/datetimepicker/bootstrap-datetimepicker.min.css') !!}

{!! Html::script('js/angular/lib/upload/ng-file-upload-shim.js') !!}
{!! Html::script('js/angular/lib/upload/ng-file-upload.js') !!}

{!! Html::script('js/angular/promotion/promotionCtrl.js') !!}
{!! Html::script('js/angular/promotion/promotionAPIService.js') !!}
<script src="https://rawgit.com/atais/angular-eonasdan-datetimepicker/0.3.8/dist/angular-eonasdan-datetimepicker.min.js"></script>
{!! Html::script('js/angular/lib/date/angular-input-date.js') !!}

<div class="container-fluid align-div-principal" ng-app="promotion" >
	<div class="row" ng-controller="promotionCtrl">
		<div class="col-md-8 col-md-offset-2 align-div-button">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Gerenciar Imagens da Promoção # <%promotion.id%></h4></div>
				<div class="panel-body">
				<div class="row">
					<!-- BUSCAR PELO ID DO PROMOÇÃO -->
					<div class="col-md-4">
						<form name="searchById">
							<div class="form-group">
								<label for="">Código da Promoção</label>
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
							<input type="checkbox" ng-model="checkboxModel.findSpeed" ng-true-value="findPromotionChangeInput(cod)" ng-false-value="' '">
						</div>
					</div>

					<div class="col-md-4">
						<label for="">Listagem</label>
						<div class="input-group">
							<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#lovPromotions" ng-click="lovPromotions()">
								<span class="glyphicon glyphicon-option-horizontal"></span>
							</button>
						</div>
					</div>

					<!-- LOV -->
					<div class="modal fade" id="lovPromotions" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Lista de Promoções</h4>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<input type="text" class="form-control" ng-model="search" placeholder="Pesquise pelo ">
									</div>
									<div class="table-lov-promotion">
										<table class="table">
											<thead>
												<tr>
													<th>Código</th>
													<th>Nome</th>
													<th>Imagens</th>
												</tr>
											</thead>
											<tbody ng-repeat='pl in promotionList | filter:{name:search}'>
												<tr>
													<td ng-click='fillForm(pl)' data-dismiss="modal"><% pl.id %></td>
													<td ng-click='fillForm(pl)' data-dismiss="modal"><% pl.name %></td>
													<td ng-click='fillForm(pl)' data-dismiss="modal"><% pl.Uploadspromotions.data.length %></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
								</div>
							</div>

						</div>
					</div>
					<!-- LOV -->

					<!-- BUSCAR PELO ID DO PROMOÇÃO -->
				</div>
				<div class="row">
					<div class="col-md-6">
						<!-- FORMULARIO DE ADICIONAR IMAGEM -->
						<div class="panel-heading">
							<h4> Inserir Imagens</h4>
						</div>
						<form name="addImgForm" enctype="multipart/form-data" >
							<input type="hidden" ng-model="promotion.id">
							<div class="col-md-4">
								<div class="form-group">
									<span class="btn btn-default btn-file">
										<input type="file" ngf-select ng-model="promotion.file" name="file"    
										accept="image/jpeg, image/x-png" ngf-max-size="2MB" 
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
				</div>
							
					<!-- lISTAR IMAGENS DO PROMOÇÃO -->

				<div class="row">
					<div class="col-md-12">
					 <div class="panel panel-default" ng-show="promotion.Uploadspromotions.data.length > 0"> 
						<div class="panel-heading">
							<h4> Total de imagens do PROMOÇÃO: <% promotion.Uploadspromotions.data.length %> </h4>
						</div>
						<div class="form-group">
							<div class="row">
								<div ng-repeat="p in promotion.Uploadspromotions.data" class="col-md-4">
									<form name="imageForm" enctype="multipart/form-data">
										<div class="panel panel-default" ng-show="promotion.Uploadspromotions.data">
											<div class="panel-heading">
												<h5>Código da imagem - # <% p.id %></h5>	
											</div>
											<img data-ng-src="<% p.way + p.original_filename %>" class="img-promotion-list img-thumbnail">
											<div class="btn-group btn-group-justified" role="group" aria-label="...">
												<div class="btn-group" role="group">
													<button class="btn btn-success btn-sm btn-block" ng-click="fillImage(p)">
														<span class="glyphicon glyphicon-ok"></span>
													</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
					<!-- lISTAR IMAGENS DO PROMOÇÃO -->
					<!-- BUSCAR PELO CÓDIGO DA IMAGEM -->
				<div class="row">
					<div class="col-md-6">
						<form name="searchImageById">
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<label for="">Código da Imagem</label>
										<div class="form-group">
											<input type="number" class="form-control" min="0" ng-model="codImg.id" ng-required="true" disabled>
										</div>
									</div> 
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-6">
					<!-- BUSCAR PELO CÓDIGO DA IMAGEM -->
					<!-- ALTERAR IMAGEM -->
					{!! Form::open(['files'=>true])!!}
						<input type="hidden" class="form-control" ng-model="codImg.id">


					
					</div>		
				</div>


				<div class="row">
				<!-- 	<div class="col-md-8">		
						<div class="align-image" ng-show="img">
							<label for="">Imagem do PROMOÇÃO</label>
							<div class="form-group">
								<img data-ng-src="<% img.way + img.original_filename %>" class="img-promotion-edit img-thumbnail">
							</div>
						</div>
					</div> -->
					<div class="col-md-4">
						<div class="form-group">
							<span class="btn btn-default btn-file">
								<input type="file" ngf-select ng-model="codImg.file" name="file"    
								accept="image/*" ngf-max-size="2MB" 
								ngf-model-invalid="errorFile">
								<span class="glyphicon glyphicon-folder-open"></span> Selecione as imagens
							</span>
						</div>
						
						<div class="form-group">
							{!! Form::button('Salvar Alteração', ['class'=>'btn btn-primary', 'ng-click'=>'updateImage()'])!!}

							{!! Form::button('Limpar', ['class'=>'btn btn-info', 'ng-click'=>'clearImage()'])!!}
						</div>
					</div>
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