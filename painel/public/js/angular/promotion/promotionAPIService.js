angular.module('promotion')
.value("config",{
 	// quando estiver em produção
    // baseUrl : "/api/admin"

    // quando estiver em localhost
    baseUrl : "/admin"
})
.factory('$promotionAPIService',
	['$rootScope', '$http', 'snackbar', 'cfpLoadingBar', '$window', 'Upload', 'config',
		 function($rootScope, $http, snackbar, cfpLoadingBar, $window, Upload, config){

	
	$rootScope._savePromotion = function(promotion){
		return Upload.upload({
			url: config.baseUrl + '/promotions/create',
			data: {
				// file			: promotion.file,
				'name'			: promotion.name,
				'title'			: promotion.title,
				'price'			: promotion.price,
				'percent'		: promotion.percent,
				'result'		: promotion.result,
				'status'		: 'ativo',	
				'dt_end'		: promotion.dt_end,
				'description'	: promotion.description
			}
		});
	};

	$rootScope._updatePromotion = function(promotion){
		return $http.post(config.baseUrl + '/promotions/update/', promotion);
	};

	var _searchPromotion = function(data){
		return $http.get(config.baseUrl + '/promotions/edit/' + data.id);
	};

	var _upsertPromotion = function(promotion){

		if(promotion.id)
			{
				return $rootScope._updatePromotion(promotion)
			}
			else 
			{
				return $rootScope._savePromotion(promotion);
			}
	};

	var _deletePromotion = function(data){
		return $http.get(config.baseUrl + '/promotions/delete/' + data);
	};

	var _addNewImage = function(promotion){
		return Upload.upload({
			url: config.baseUrl + '/promotions/addNewImage',
			data: {
				file			: promotion.file,
				'id'			: promotion.id
			}
		});
	};

	var _verifyPromotion = function(data){
		if(data.data.status === 4 ){
			cfpLoadingBar.complete();
			snackbar.create(' ' + data.data.message + '');
		}else{
			cfpLoadingBar.complete();
			$rootScope.promotion  = data.data.data;
			snackbar.create('Operação realizada com sucesso!');
		}
	};

	var _getLovPromotion = function(data){
		return $http.get(config.baseUrl + '/promotions/show');
	};

	var _updateImage = function(promotion){
		return Upload.upload({
			url: config.baseUrl + '/promotions/updateImage',
			data: {
				file			: promotion.file,
				'id'			: promotion.id
			}
		});
	};

	return {

		upsertPromotion		: _upsertPromotion,

		searchPromotion		: _searchPromotion,

		deletePromotion		: _deletePromotion,

		addNewImage 		:_addNewImage,

		verifyPromotion     :_verifyPromotion,

		getLovPromotion		:_getLovPromotion,

		updateImage		 	:_updateImage
	}	 	
}]);

