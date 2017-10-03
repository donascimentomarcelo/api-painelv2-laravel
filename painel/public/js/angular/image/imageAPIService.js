angular.module('image').factory('$imageAPIService',
	 ['$rootScope', '$http', 'snackbar', 'cfpLoadingBar', '$window', 'Upload', 
	 		function($rootScope, $http, snackbar, cfpLoadingBar, $window, Upload){

			 var _verifyDataProject = function(data){
			 	if(parseInt(data.data.status) === 1)
			 	{
			 		cfpLoadingBar.complete();
			 		snackbar.create('Operação realizada com sucesso!');
			 		// $window.location.href = '/admin/project/list';
			 	}
			 	else if(parseInt(data.data) === 3)
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
			 }

			var _updateImage = function(data){
				return Upload.upload({
                        url: '/admin/image/update',
                        data: {
                            file               : data.file,
                            'id'               : data.id,
                            'order'            : data.order
                        }
                    });
			}

	 return {

	 	verifyDataProject : _verifyDataProject,

		updateImage       : _updateImage
	 };

}])