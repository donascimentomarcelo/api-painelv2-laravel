angular.module('project').factory('$projectVerifyAPIService',
	 ['$rootScope', '$http', 'snackbar', 'cfpLoadingBar', '$window', 'Upload', 
	 		function($rootScope, $http, snackbar, cfpLoadingBar, $window, Upload){

			 var _verifyDataProject = function(data){
			 	if(parseInt(data.data.status) === 1)
			 	{
			 		cfpLoadingBar.complete();
			 		snackbar.create('Operação realizada com sucesso!');
			 	}
			 	else if(parseInt(data.data.status) === 333)
			 	{
			 		cfpLoadingBar.complete();
			 		snackbar.create(''+ data.data.message +'');	
			 	}
			 	else
			 	{
			 		console.log(data.data); 
			 		cfpLoadingBar.complete();
			 		snackbar.create('Houve um erro ao criar o projeto!');	
			 	}
			 }

		
			var _verifyDataImage = function(data){
				if(parseInt(data.data.status) === 1)
				{
					cfpLoadingBar.complete();
                	snackbar.create('Imagem inserida com sucesso!');
                	$rootScope.project = data.data.return.data;
				}
				else if(parseInt(data.data.status) === 3)
				{
					cfpLoadingBar.complete();
                	snackbar.create('Só serão aceitas imagens jpeg, jpg e png!');
				}
				else
				{
					cfpLoadingBar.complete();
                	snackbar.create('Houve um erro ao inserir a imagem!');
				}
			};

			var _verifyResponseEdit = function(data){
				if(parseInt(data.data.status) === 200)
				{
					cfpLoadingBar.complete();
		            $rootScope.project = data.data.return.data;
		            $rootScope.containerImg = true;	
				}
				else if(parseInt(data.data.status) === 404) 
				{
					cfpLoadingBar.complete();
					$rootScope.containerImg = false;	
					snackbar.create(''+ data.data.message +'');
				}
			}

	 return {

	 	verifyDataProject  : _verifyDataProject,

		verifyDataImage    : _verifyDataImage,

		verifyResponseEdit : _verifyResponseEdit


		};

}])