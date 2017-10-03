@extends('app')

@section('content')

{!! Html::style('css/style.css') !!}
{!! Html::style('css/altered.css') !!}

{!! Html::script('js/angular/lib/loading-bar.js') !!}
{!! Html::style('js/angular/lib/loading-bar.css') !!}

{!! Html::script('js/angular/user/userListCtrl.js') !!}
{!! Html::script('js/angular/user/userAPIService.js') !!}
{!! Html::script('js/angular/lib/pagination/simplePagination.js') !!}

<div class="container-fluid align-div-principal" ng-app="user">
	<div class="row" ng-controller="listUserCtrl">
		<div class="col-md-8 col-md-offset-2 align-div-button">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Lista de usuário</h4></div>
				<div class="panel-body">
					<div id="loading-bar-container"></div>
					<form name="searchById" ng-show="users.length > 0">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
								<label for="">Nome do Usuário</label>
									<div class="input-group">
										<input type="text" class="form-control" ng-model="search">
										<span class="input-group-btn">
											<button class="btn btn-primary" type="button" disabled="true">
												<span class="glyphicon glyphicon-search"></span>
											</button>
										</span>
									</div>
								</div> 
							</div>
						</div>
					</form>
					<table class="table" ng-show="users.length > 0">
 						<thead>
							<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>E-mail/Login</th>
							</tr>
							<tbody>
								<tr ng-repeat="user in users | startFrom: pagination.page * pagination.perPage | limitTo: pagination.perPage | filter:{name:search}">
									<td><% user.id %></td>
									<td><% user.name %></td>
									<td><% user.email %></td>
								</tr>
							</tbody>
						</thead>
					</table>
					<div ng-show="users.length > 0">  
						<ul class="pagination" ng-show="users.length > 0">
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
