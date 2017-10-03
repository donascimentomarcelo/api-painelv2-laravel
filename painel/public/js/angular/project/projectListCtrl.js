angular.module('project',['cfp.loadingBar', 'angular.snackbar', 'simplePagination'])
.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
    cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
}])
.value("config",{
    // quando estiver em produção
    // baseUrl : "/api/admin"

    // quando estiver em localhost
    baseUrl : "/admin"
    
})
.controller('projectListCtrl',['$rootScope', '$http', 'cfpLoadingBar', 'config', 'Pagination',
				function($rootScope, $http, cfpLoadingBar, config, Pagination){
	var loadProject = function(){
		cfpLoadingBar.start();
		var promise = $http.get( config.baseUrl + '/project/list');
		promise.then(function(data){
			cfpLoadingBar.complete();
			$rootScope.projects = data.data.data;
			$rootScope.pagination = Pagination.getNew(10);
			$rootScope.pagination.numPages = Math.ceil($rootScope.projects.length/$rootScope.pagination.perPage);
		}, function(dataError){
			cfpLoadingBar.complete();
			snackbar.create('Houve um erro ao carregar os projetos!');
			console.log(dataError);
		});
	};

	loadProject();
}]);