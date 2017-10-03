angular.module('promotion',['cfp.loadingBar', 'angular.snackbar', 'ngFileUpload', 'ngInputDate'])
.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
    cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
}])
.controller('promotionCtrl',['$rootScope', '$http', 'cfpLoadingBar', 'snackbar', 'Upload', '$promotionAPIService',
	function($rootScope, $http, cfpLoadingBar, snackbar, Upload, $promotionAPIService){
		now = new Date;
		$rootScope.getDate   = now.getDate() + " / " + now.getMonth() + " / " + now.getFullYear() ;
		$rootScope.promotion = [];
		$rootScope.save = function(){
			console.log($rootScope.promotion)
			if($rootScope.promotion.file)
			{
				$rootScope.upload($rootScope.promotion);
			}
			else if(!$rootScope.promotion.file && $rootScope.promotion.id)
			{
				$rootScope.update($rootScope.promotion)
			}
			else
			{
				snackbar.create('Você precisa anexar uma imagem a promoção.');
			}
		};

		$rootScope.update = function(){
			cfpLoadingBar.start();

		};

		$rootScope.upload = function(promotion){
			cfpLoadingBar.start();
			var promise = $promotionAPIService.savePromotion(promotion);

			promise.then(function(data){
				$rootScope.promotion = data.data.data;
				$promotionAPIService.verifyDataPromotion(data);
			},function(resp){
				cfpLoadingBar.complete();
				snackbar.create('Houve um erro ao criar o projeto!');   
				console.log('Error status: ' + resp.status);
				console.log('Error status: ' + resp);
			},function(evt){
				var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
				console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
			});
		};

		$rootScope.findPromotionChangeInput = function(data){

		};

}])

