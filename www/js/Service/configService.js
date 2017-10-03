angular.module('myApp').factory('$configAPIService',['$rootScope', '$document' , function($rootScope, $document){

			var _getStuff = function(){
				return $rootScope.stuff = [
				"Procura um Programador?", 
				"Procura um Web Designer?", 
				"Procura um aplicativo?", 
				"Você veio ao lugar certo!", 
				];
			};
			var _getMenuConfig = function(){
				return  $rootScope.menuConfig3 = {
					"buttonWidth": 60,
					"menuRadius": 180,
					"color": "rgba(8, 8, 8, 0.57)",
					"offset":25,
					"textColor": "#ffffff",
					"showIcons":true,
					"onlyIcon":false,
					"textAndIcon": true,
					"gutter": {
						"top": 130,
						"right": 30,
						"bottom": 30,
						"left": 30
					},
					"angles": {
						"topLeft": 0,
						"topRight": 90,
						"bottomRight": 180,
						"bottomLeft": 270
					}
				};
			};
			var _getMenuItems = function(){
				return $rootScope.menuItems = [{
					"title": "inicio",
					"color": "rgba(8, 8, 8, 0.79);",
					"rotate": 0,
					"show": 0,
					"titleColor": "#fff",
					"icon":{"color":"#fff","name":"fa fa-home","size": 30}
				}, {
					"title": "perfil",
					"color": "rgba(51, 51, 51, 0.88)",
					"rotate": 0,
					"show": 0,
					"titleColor": "#fff",
					"icon":{"color":"#fff","name":"fa fa-user-circle-o","size": 30}
				}, {
					"title": "projeto",
					"color": "rgba(85, 85, 85, 0.88)",
					"rotate": 0,
					"show": 0,
					"titleColor": "#fff",
					"icon":{"color":"#fff","name":"fa fa-file-code-o","size": 30}
				}, {
					"title": "contato",
					"color": "rgba(153, 153, 153, 0.93)",
					"rotate": 0,
					"show": 0,
					"titleColor": "#fff",
					"icon":{"color":"#fff","name":"fa fa-envelope-open-o","size": 30}
				}];
			};


			var _getOnWingClick = function(wing){
				
				var inicio   = angular.element(document.getElementById('inicio')),
				perfil   = angular.element(document.getElementById('perfil')),
				projetos = angular.element(document.getElementById('projetos')),
				contato  = angular.element(document.getElementById('contato'))

				if(wing.title === 'inicio')
				{
					$document.scrollTo(inicio, 0, 1000);
				}
				else if(wing.title === 'perfil')
				{
					$document.scrollTo(perfil, 0, 1000);
				}
				else if(wing.title === 'projeto')
				{
					$document.scrollTo(projetos, 0, 1000);
				}
				else if(wing.title === 'contato')
				{
					$document.scrollTo(contato, 0, 1000);
				}
				else
				{
					$document.scrollTo(inicio, 0, 1000);
				}
			}

	return {
		getStuff      : _getStuff,

		getMenuConfig : _getMenuConfig,

		getMenuItems  : _getMenuItems,

		getOnWingClick: _getOnWingClick
	};
}]);