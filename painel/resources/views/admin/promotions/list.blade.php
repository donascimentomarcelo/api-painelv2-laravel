@extends('app')

@section('content')

{!! Html::style('css/style.css') !!}
{!! Html::style('css/altered.css') !!}

{!! Html::script('js/angular/lib/loading-bar.js') !!}
{!! Html::style('js/angular/lib/loading-bar.css') !!}


<div class="container-fluid align-div-principal">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 align-div-button">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Lista de Promoções</h4></div>
				<div class="panel-body">
				<div id="loading-bar-container"></div>
				<div class="form-group">
					<input ng-model="search" class="form-control" placeholder="Pesquise pelo nome do projeto...">
				</div>
					<table class="table" ng-show='projects.length > 0'>
						<thead>
							<tr>
								<th class="text-table">Código</th>
								<th class="text-table">Nome do Projeto</th>
								<th class="text-table">Link</th>
								<th class="text-table">Imagens</th>
							</tr>
							<tbody>
								<tr>
									<td class="text-table"></td>
									<td class="text-table"></td>
									<td class="text-table"></td>
									<td class="text-table">
										<button type="button" class="btn btn-info btn-sm btn-block" data-toggle="collapse" data-target="#<% project.id %>">
											<span class="glyphicon glyphicon-picture"></span>
										</button>	
									</td>
								</tr>
								<tr >
									<td colspan="5">
										<div id="<% project.id %>" class="collapse">
											<div class="row">
												<div class="col-sm-4" ng-repeat='upload in project.upload.data'>
													<img data-ng-src="<% upload.way + upload.original_filename %>" class="img-project" alt="">
												</div>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</thead>
					</table>
					<div ng-show="projects.length > 0">  
						<ul class="pagination" ng-show="projects.length > 0">
							<li><a href="" ng-click="pagination.prevPage()">&laquo;</a></li>
							<li ng-repeat="n in [] | range: pagination.numPages" ng-class="{active: n == pagination.page}">
								<a href="" ng-click="pagination.toPageId(n)"><% n + 1 %></a>
							</li>
							<li><a href="" ng-click="pagination.nextPage()">&raquo;</a></li>
						</ul>
					</div>
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
