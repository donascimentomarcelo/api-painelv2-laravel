angular.module('image',['cfp.loadingBar', 'angular.snackbar', 'ngFileUpload'])
.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
    cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
}])
.controller('imageCtrl', ['$scope','$http', 'cfpLoadingBar', '$imageAPIService', 'snackbar',
    function ($scope, $http, cfpLoadingBar, $imageAPIService, snackbar) {


     $scope.update = function(image){
        var file = image.file;

        if (file) {
            $scope.upload(image);
        }
        else
        {
            snackbar.create('Você precisa anexar uma imagem ao projeto.');
        }
    }

    $scope.upload = function (image) {
        console.log(image)
        // cfpLoadingBar.start();
        // var promise = $imageAPIService.updateImage(image);

        // promise.then(function (data) {
        //     console.log(data)
        //     console.log(data.data)
        //     $imageAPIService.verifyDataProject(data);
        // }, function (resp) {
        //     cfpLoadingBar.complete();
        //     snackbar.create('Houve um erro ao criar o projeto!');   
        //     console.log('Error status: ' + resp.status);
        // }, function (evt) {
        //     var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
        //     console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
        // });
    };

}])