angular.module('user', ['cfp.loadingBar', 'angular.snackbar', 'simplePagination'])
.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
	cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
	cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
}])
.controller('listUserCtrl', ['$scope','$userAPIService', 'Pagination', 'cfpLoadingBar', 
		function ($scope, $userAPIService, Pagination, cfpLoadingBar) {
	var load = function(){
		cfpLoadingBar.start();
		var promise = $userAPIService.listUser();
		promise.then(function(data){
			cfpLoadingBar.complete();
			$scope.users = data.data.data;
			$scope.pagination = Pagination.getNew(10);
			$scope.pagination.numPages = Math.ceil($scope.users.length/$scope.pagination.perPage);
		},function(dataError){
			console.log(dataError);
		});
	};


	load();
}])