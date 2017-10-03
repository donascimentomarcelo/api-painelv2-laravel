angular.module('user', ['cfp.loadingBar', 'angular.snackbar', 'simplePagination'])
.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
	cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
	cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
}])
.controller('userCtrl',[ '$scope', '$http','cfpLoadingBar', '$window', 'snackbar', '$userAPIService', 'Pagination',
	function($scope, $http, cfpLoadingBar, $window, snackbar, $userAPIService, Pagination){

	$scope.save = function(data){
		$userAPIService.validateConfirmPassword(data);
			cfpLoadingBar.start();
			var promise = $userAPIService.verifyIfExistId(data);
				promise.then(function(data){
					$userAPIService.verifyDataUser(data);
			},function(dataError){
				cfpLoadingBar.complete();
				console.log(dataError);
			});
	};

	$scope.edit =  function(data){
		var id = data.id;
		cfpLoadingBar.start();
		var promise = $userAPIService.getId(id);
			promise.then(function(data){
				cfpLoadingBar.complete();
				$scope.user = data.data.data;
			}, function(dataError){
				cfpLoadingBar.complete();
				if(parseInt(dataError.status) == 404)
				{
					snackbar.create('Usuário não encontrado!');
				};
			});
	};

	$scope.clear = function(){
		delete $scope.user;
		delete $scope.cod;
	}
// Jynx Maze
}]);