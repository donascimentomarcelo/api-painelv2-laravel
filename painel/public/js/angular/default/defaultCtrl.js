angular.module('default', ['cfp.loadingBar', 'angular.snackbar','googlechart'])
.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
    cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
}])
.controller('ctrlDefault', [  '$rootScope','$http','cfpLoadingBar', 'snackbar',
	function($rootScope,$http,cfpLoadingBar, snackbar){


}])