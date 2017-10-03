angular.module('user')
.value("config",{
    // quando estiver em produção
    // baseUrl : "/api/admin"

    // quando estiver em localhost
    baseUrl : "/admin"
    
})
.factory('$userAPIService',
	['$rootScope', '$http' , 'snackbar', 'cfpLoadingBar', '$window', 'config',
			function ($rootScope, $http, snackbar, cfpLoadingBar, $window, config) {
	
				var _validateConfirmPassword = function(data){
					if(data)
					{
						if(data.password != data.confirmpassword)
							return snackbar.create('A senha precisa ser igual a confirmação de senha.');
						return;
					}
				};

				var _verifyDataUser = function(data){
					if(parseInt(data.data) === 1)
					{
						cfpLoadingBar.complete();
						$window.location.href = config.baseUrl + '/painel/list';
					}
					else if(parseInt(data.data) === 3)
					{
						cfpLoadingBar.complete();
						snackbar.create('Preencha todos os campos!');	
					}
				};

				var _verifyIfExistId = function(data){
					
					if(!data.id)
					{
						return _saveUser(data)
					}
					else
					{
						return _updateUser(data)
					}
				}

				var _saveUser = function(data){
					return $http.post( config.baseUrl + '/painel/save', data);
				};

				var _updateUser = function(data){
					return $http.post( config.baseUrl + '/painel/update', data);
				};

				var _listUser = function(){
					return $http.get( config.baseUrl + '/painel/index');
				};
				
				var _getId = function(id){
					return $http.get( config.baseUrl + '/painel/edit/' + id)
				};
	return {
		validateConfirmPassword : _validateConfirmPassword,

		verifyDataUser          : _verifyDataUser,

		saveUser                : _saveUser,

		updateUser              : _updateUser,

		listUser                : _listUser,

		verifyIfExistId         : _verifyIfExistId,

		getId					: _getId
	};
}])

