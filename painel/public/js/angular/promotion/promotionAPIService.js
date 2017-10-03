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

	
	var _savePromotion = function(promotion){
		return Upload.upload({
			url: config.baseUrl + '/promotions/create',
			data: {
				file			: promotion.file,
				'name'			: promotion.name,
				'title'			: promotion.title,
				'status'		: promotion.status,	
				'dt_start'		: promotion.dt_start,
				'dt_end'		: promotion.dt_end,
				'description'	: promotion.description
			}
		});
	};

	var _verifyDataPromotion = function(data){
		if(parseInt(data.data.status) === 1)
		{
			cfpLoadingBar.complete();
			snackbar.create('Operação realizada com sucesso!');
		}
		else if (parseInt(data.data) === 3)
		{
			cfpLoadingBar.complete();
			snackbar.create('Só serão aceitas imagens no formato jpg, jpeg e png.');
		}
		else
		{
			console.log(data.data); 
			cfpLoadingBar.complete();
			snackbar.create('Houve um erro ao criar o projeto!');	
		}
	};

	return {
		savePromotion 		: _savePromotion,

		verifyDataPromotion : _verifyDataPromotion
	}	 	
}]);

