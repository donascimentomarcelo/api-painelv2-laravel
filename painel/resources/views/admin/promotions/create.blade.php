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
												<input type="number" class="form-control" min="0" ng-model="cod.id" ng-required="true" ng-change='<% checkboxModel.findSpeed %>'>
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
							</div>

							<div class="row">
								<div class='col-md-4'>
									<div class="form-group">
										<label for="date-birth" class="control-label">Data de criação:</label>
										<div class="form-group date">
											<input class="form-control" type="datetime-local"  ng-model="promotion.created_at" disabled="true">
										</div>
									</div>
								</div>
								<div class='col-md-4'>
									<div class="form-group">
										<label for="date-birth" class="control-label">Data de fim:</label>
										<div class="form-group date">
											<input class="form-control" type="datetime-local"  ng-model="promotion.dt_end">
										</div>
									</div>
								</div>
								<div class='col-md-4'>
									<div class="form-group">
										<label for="date-birth" class="control-label">Ultima atualização:</label>
										<div class="form-group date">
											<input class="form-control" type="datetime-local"  ng-model="promotion.updated_at" disabled="true">
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										{!! Form::label('Preço', 'Preço') !!}
										{!! Form::number('price', null, ['class' => 'form-control', 'ng-model'=>'promotion.price', 'min'=>'0', 'ng-change'=>'sumPercent()']) !!}
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										{!! Form::label('Desconto em porcentagem', 'Desconto em porcentagem') !!}
										{!! Form::number('percent', null, ['class' => 'form-control', 'ng-model'=>'promotion.percent', 'min'=>'0', 'ng-change'=>'sumPercent()']) !!}
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										{!! Form::label('Resultado', 'Resultado') !!}
										{!! Form::number('result', null, ['class' => 'form-control', 'ng-model'=>'promotion.result', 'my-directive', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										{!! Form::label('Status', 'Status') !!}
										{!! Form::text('status', null, ['class' => 'form-control', 'ng-model'=>'promotion.status', 'disabled']) !!}
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										{!! Form::label('Responsável', 'Responsável') !!}
										{!! Form::text('responsable', null, ['class' => 'form-control', 'ng-model'=>'promotion.responsable', 'disabled']) !!}
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										{!! Form::label('E-mail', 'E-mail') !!}
										{!! Form::text('email', null, ['class' => 'form-control', 'ng-model'=>'promotion.email', 'disabled']) !!}
									</div>
								</div>
							</div>
						
							
							<div class="row">
								<div class="col-md-12">	
									<div class="form-group">
										{!! Form::label('Descrição', 'Descrição') !!}
										{!! Form::textarea('description', null, ['class' => 'form-control', 'ng-model'=>'promotion.description', 'cols'=>'5','rows'=>'5' ]) !!}
									</div>
								</div>
							</div>

						
						<div class="form-group">
						{!! Form::button('Salvar', ['class'=>'btn btn-primary', 'ng-click'=>'save()', 
							'ng-disabled'=>'!(promotion.name && promotion.title && promotion.price && promotion.percent && promotion.dt_end && promotion.description)'])!!}
						
						{!! Form::button('Limpar', ['class'=>'btn btn-info', 'ng-click'=>'clear()', 
							'ng-disabled'=>'!(promotion.name && promotion.title && promotion.price && promotion.percent && promotion.dt_end && promotion.description)'])!!}

						{!! Form::button('Excluir', ['class'=>'btn btn-danger','ng-disabled'=>'!(promotion.id)', 
							'data-toggle'=>'modal', 'data-target'=>'#confirmDeleteImage'])!!}
						</div>

						<!-- CONFIRM DELETE-->
						<div id="confirmDeleteImage" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Deseja realmente excluir essa promoção?</h4>
									</div>
									<div class="modal-body">
										<p>Ao excluir a promoção a mesma não poderá ser recuperada.</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

										<button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="delete(promotion.id)">Confirmar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- CONFIRM DELETE-->

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