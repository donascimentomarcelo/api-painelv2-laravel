angular.module('project')
.value("config",{
    // quando estiver em produção
    // baseUrl : "/api/admin"

    // quando estiver em localhost
    baseUrl : "/admin"
    
})
.factory('$projectAPIService',
	 ['$rootScope', '$http', 'snackbar', 'cfpLoadingBar', '$window', 'Upload', 'config',
	 		function($rootScope, $http, snackbar, cfpLoadingBar, $window, Upload, config){

			 var _verifyDataProject = function(data){
			 	if(parseInt(data.data.status) === 1)
			 	{
			 		cfpLoadingBar.complete();
			 		snackbar.create('Operação realizada com sucesso!');
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

			var _saveProject = function(project){
				return Upload.upload({
						url: config.baseUrl + '/project/save',
						data: {

							// file         : project.file, 
							'name'       : project.name, 
							'link'       : project.link, 
							'description': project.description, 
							'category'   : project.category
						}

					});
			};

			var _updateProject = function(project){
				return Upload.upload({
						url: config.baseUrl + '/project/update',
						data: {

							'name'       : project.name, 
							'id'         : project.id, 
							'link'       : project.link, 
							'description': project.description, 
							'category'   : project.category
						}

					});
			};

			var _updateImage = function(data){
				return Upload.upload({
                        url: config.baseUrl + '/image/update',
                        data: {
                            file               : data.file,
                            'id'               : data.id,
                            'original_filename': data.original_filename
                        }
                    });
			};

			var _addImage = function(data){
				return Upload.upload({
                        url: config.baseUrl + '/image/save',
                        data: {
                            file               : data.file,
                            'id'               : data.id
                        }
                    });
			};

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

			var _getEdit = function(data){
				return $http.get( config.baseUrl + '/project/edit/' + data.id);
			};

			var _getEditImage = function(data){
				return $http.get( config.baseUrl + '/image/edit/' + data.id);
			};

			var _getDeleteImage = function(data){
				return $http.post( config.baseUrl + '/image/destroy/' + data.id);
			};

			var _updateOrder = function(data){
				
				return $http.post( config.baseUrl + '/image/updateOrder', data);
			};

			var _listProjects = function(){
				return $http.get( config.baseUrl + '/project/list');
			};

	 return {

	 	verifyDataProject : _verifyDataProject,

		saveProject       : _saveProject,

		updateProject     : _updateProject,

		updateImage       : _updateImage,

		addImage          : _addImage,

		verifyDataImage   : _verifyDataImage,

		getEdit           : _getEdit,

		getEditImage      : _getEditImage,

		getDeleteImage    : _getDeleteImage,

		updateOrder		  : _updateOrder,

		listProjects      : _listProjects
	 };

}])