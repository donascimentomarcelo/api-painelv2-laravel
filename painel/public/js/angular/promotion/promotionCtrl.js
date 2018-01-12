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

		$rootScope.promotion = [];

		$rootScope.save = function(){
			cfpLoadingBar.start();
			var promise = $promotionAPIService.upsertPromotion($rootScope.promotion);
			promise.then(function(data){
				cfpLoadingBar.complete();
				$rootScope.promotion = data.data.data;
				snackbar.create('Operação realizada com sucesso!');
			},function(dataError){
				cfpLoadingBar.complete();
				snackbar.create('Houve um erro ao realizar operação!');
				console.log(dataError);
			});
		};

		$rootScope.delete = function(data){
			cfpLoadingBar.start();
			var promise = $promotionAPIService.deletePromotion(data);

			promise.then(function(data){
				console.log(data)
				cfpLoadingBar.complete();
				$rootScope.clear();
				snackbar.create('Registro excluido com sucesso!');
			},function(dataError){
				cfpLoadingBar.complete();
				snackbar.create('Houve um erro ao deletar o registro!');
			});
		};


		$rootScope.sumPercent = function(){
			$rootScope.promotion.aux = parseFloat($rootScope.promotion.price) * (parseFloat($rootScope.promotion.percent)/100);
			$rootScope.promotion.result = $rootScope.promotion.price - $rootScope.promotion.aux;

			console.log($rootScope.promotion.result)
			// $scope.example.substring($scope.example.length -1)
		};

		$rootScope.findPromotionChangeInput = function(data){
			$rootScope.edit(data);
		};

		$rootScope.edit = function(id){

			var promise = $promotionAPIService.searchPromotion(id);

			promise.then(function(data){
				$rootScope.promotion  = data.data.data;
			},function(dataError){
				snackbar.create('Promoção não encontrada!');
			});
		};

		$rootScope.clear = function()
		{
			 $rootScope.promotion = [];
		};

		$rootScope.addImage = function()
		{
			if(!$rootScope.promotion.file){
				return snackbar.create('Seleciona uma imagem no formato .jpeg, .jpg ou .png!')
			}
			extensoes_permitidas = new Array(".jpeg", ".jpg", ".png"); 
			extensao = ($rootScope.promotion.file.name.substring($rootScope.promotion.file.name.lastIndexOf("."))).toLowerCase(); 
      		permitida = false; 
			for (var i = 0; i < extensoes_permitidas.length; i++) { 
				if (extensoes_permitidas[i] == extensao) { 
					permitida = true; 
					break; 
				} 
			} 
			if (!permitida) 
			{ 
				snackbar.create('Serão aceitas apenas imagens no formato ' + extensoes_permitidas.join());
			}
			else
			{ 
				cfpLoadingBar.start()
				var promise = $promotionAPIService.addNewImage($rootScope.promotion);

				promise.then(function(data){
					$promotionAPIService.verifyPromotion(data);
				},function(dataError){
					cfpLoadingBar.complete();
					console.log(dataError);
					snackbar.create('Houve um erro ao inserir imagem');
				});
         	}; 
		};

		$rootScope.fillImage = function(cod)
		{
			$rootScope.codImg = cod;
		};

		$rootScope.clearImage = function()
		{
			$rootScope.cod = [];
			$rootScope.codImg = [];
			$rootScope.img = [];
			$rootScope.promotion.Uploadspromotions.data.length = 0
		};

		$rootScope.fillForm = function(data){
			$rootScope.promotion  = data;
		};

		$rootScope.lovPromotions = function(){
			cfpLoadingBar.start();
			var promise = $promotionAPIService.getLovPromotion();
			promise.then(function(data){
				cfpLoadingBar.complete();
				$rootScope.promotionList = data.data.data;
			},function(dataError){
				cfpLoadingBar.complete();
				console.log(dataError);
				snackbar.create('Houve um erro ao listar valores!');
			});
		};

		$rootScope.updateImage = function(){

			if(!$rootScope.codImg){
				return snackbar.create('Seleciona a promoção!')
			}
			if(!$rootScope.codImg.file){
				return snackbar.create('Seleciona uma imagem no formato .jpeg, .jpg ou .png!')
			}

			extensoes_permitidas = new Array(".jpeg", ".jpg", ".png"); 
			extensao = ($rootScope.codImg.file.name.substring($rootScope.codImg.file.name.lastIndexOf("."))).toLowerCase(); 
			permitida = false; 
			for (var i = 0; i < extensoes_permitidas.length; i++) { 
				if (extensoes_permitidas[i] == extensao) { 
					permitida = true; 
					break; 
				} 
			} 
			if (!permitida) 
			{ 
				return snackbar.create('Serão aceitas apenas imagens no formato ' + extensoes_permitidas.join());
			}
			else
			{ 
				cfpLoadingBar.start();
				var promise = $promotionAPIService.updateImage($rootScope.codImg);
				promise.then(function(data){
					cfpLoadingBar.complete();
					$rootScope.promotion = data.data.data;
				},function(data){
					cfpLoadingBar.complete();

				});
			};
		};

}])
.directive('myDirective', function($filter) {
    return {
      require: 'ngModel',
      link: function(scope, element, attrs, ngModelController) {
        ngModelController.$formatters.push(function(data) {
          // return $filter('number')(data, 2);
          return Math.round(data).toFixed(2);
        });
      }
    }
  })
