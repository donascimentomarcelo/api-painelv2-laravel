angular.module('myApp', [
              'angular-carousel',
              'ui.router',
              'angularTypewrite',
              'angular-parallax',
              'duScroll',
              'circularMenu-directive',
              'angular-loading-bar',
              'angular.snackbar',
              'ui.bootstrap']
  )
.config(function($stateProvider, $urlRouterProvider){
	$stateProvider
	.state('home',{
		url:'/',
		templateUrl:'templates/home.html',
		controller:'myController'
	})
	$urlRouterProvider.otherwise('/');
})
.value('duScrollDuration', 2000)
.value('duScrollOffset', 30)
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
    cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
  }])
.controller('myController',
                    ['$scope', 
                     '$document', 
                     '$location', 
                     '$http',
                     'snackbar',
                     'Carousel',
                     '$configAPIService',
                           function($scope, 
                                    $document, 
                                    $location, 
                                    $http, 
                                    snackbar,
                                    Carousel,
                                    $configAPIService){
 
    		$scope.stuff = $configAPIService.getStuff();
     
        $scope.menuConfig3 = $configAPIService.getMenuConfig();

        $scope.menuItems = $configAPIService.getMenuItems();

        $scope.onWingClick = function(wing){
           return $configAPIService.getOnWingClick(wing);
       };

       $scope.sendEmail = function(data){
          var promise = $http.post('http://marceloprogrammer.com/api/painel/email', data);
              promise.then(function(data){
                ignoreLoadingBar: true;
                delete $scope.data;
                 snackbar.create("E-mail enviado com sucesso!");
                console.log(data);
              }, function(responseError){
                ignoreLoadingBar: true;
                 snackbar.create("Houve um erro ao enviar o e-mail!");
                console.log(responseError);
              });
       };
       $scope.registerNews = function(data){
        var promise = $http.post('http://marceloprogrammer.com/api/emails/create', data);
        promise.then(function(data){
          snackbar.create("Verifique sua caixa de e-mail para validação");
        }, function(responseError){
          snackbar.create("Houve um erro no cadastro!");
        })
       }
       var loadProject = function(){
        var promise = $http.get('http://localhost:8000/api/project/list');
        // var promise = $http.get('http://marceloprogrammer.com/api/api/project/list');
          promise.then(function (data){
            ignoreLoadingBar: true;
            $scope.dataProjects = data.data.data;
          },
           function(responseError){
            ignoreLoadingBar: true;
            console.log(responseError);
          });
       };

      $scope.Carousel = Carousel;
       loadProject();

}]).value('duScrollOffset', 30)