angular.module('project',['cfp.loadingBar', 'angular.snackbar', 'ngFileUpload'])
.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
    cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
}])
.controller('projectCtrl', ['$rootScope','$http', 'Upload','cfpLoadingBar', '$projectAPIService', '$projectVerifyAPIService','snackbar',
    function ($rootScope, $http, Upload, cfpLoadingBar, $projectAPIService, $projectVerifyAPIService, snackbar) {

     $rootScope.project = [];

     $rootScope.save = function(){

        if($rootScope.project.id)
        {
            $rootScope.update($rootScope.project);
        }
        else
        {
            $rootScope.createProject($rootScope.project);
        }
    }

    $rootScope.createProject = function (project) {
        cfpLoadingBar.start();
        var promise = $projectAPIService.saveProject(project);

        promise.then(function (data) {
            cfpLoadingBar.complete();
            snackbar.create('Projeto ' + data.data.data.id + ' salvo com sucesso!');
            // delete $rootScope.project;
            $rootScope.project = [];
            // erro Cannot read property 'id' of undefined qnd descomenta essa linha
        }, function (resp) {
            cfpLoadingBar.complete();
            snackbar.create('Houve um erro ao criar o projeto!');   
            console.log('Error status: ' + resp.status);
            console.log('Error status: ' + resp);
        });
    };

    $rootScope.findProjecChangeInput = function(data){
        $rootScope.edit(data);
    }

    $rootScope.edit = function(data){
        if(!data.id)
        {
            return snackbar.create('Insira o código da pesquisa!')
        }
        // cfpLoadingBar.start();
        var promise = $projectAPIService.getEdit(data);

        promise.then(function(data){
            $projectVerifyAPIService.verifyResponseEdit(data);
        }, function(dataError){
            console.log(dataError)
            delete $rootScoope.project;
            delete $rootScoope.cod;
            if(parseInt(dataError.status) === 404){  
                snackbar.create('Esse projeto não existe!'); 
                delete $rootScoope.project;
            }
        })
    };


    $rootScope.update = function(data){
        cfpLoadingBar.start();
        var promise = $projectAPIService.updateProject(data);
        promise.then(function(data){
            cfpLoadingBar.complete();
            $rootScope.project = data.data.data;
            $projectVerifyAPIService.verifyDataProject(data);
        }, function(dataError){
            console.log(dataError);
            cfpLoadingBar.complete();
            snackbar.create('Houve um erro ao atualizar o projeto!');
        })
    };

    $rootScope.deleteProject = function(){
        cfpLoadingBar.start();

        var promise = $projectAPIService.destroyProject($rootScope.project);
        promise.then(function(data){
            console.log(data)
            cfpLoadingBar.complete();
            snackbar.create("Projeto excluido com sucesso!");
            delete $rootScope.project;
        }, function(data){
            cfpLoadingBar.complete();
            snackbar.create("Erro ao excluir projeto!");
        })
    }

    $rootScope.img = [];
    $rootScope.updateImage = function(){
        if(!$rootScope.img.id)
        {
            return snackbar.create('Selecione um projeto!');
        };

        if($rootScope.img.file)
        {
           $rootScope.updateImageApply($rootScope.img);
        }
        else if(!$rootScope.img.file && $rootScope.img.order)
        {
            $rootScope.updateOnlyOrderApply($rootScope.img)
        }
        else
        {
            snackbar.create('Selecione uma imagem!');
        };
    };

    $rootScope.updateImageApply = function(dataImg){

        if(!$rootScope.img.id){
            return snackbar.create('Selecione um projeto!');
        };

        var ext = $rootScope.img.file[0].name.match(/\.(.+)$/)[1];

        if(angular.lowercase(ext) ==='jpg' || angular.lowercase(ext) ==='jpeg' || angular.lowercase(ext) ==='png'){
            cfpLoadingBar.start();
            var promise = $projectAPIService.updateImage(dataImg);
            promise.then(function(data){
                $rootScope.img = data.data.img.data;
                $rootScope.project = data.data.project.data;
                cfpLoadingBar.complete();
                snackbar.create('Imagem atualizada com sucesso!');
            }, function(dataError){
                cfpLoadingBar.complete();
                console.log(dataError);
                snackbar.create('Houve um erro ao atualizar a imagem!');
            });
        }
        else
        {
            snackbar.create('Serão aceitas apenas imagens no formato .jpeg, .jpg e .png!');
        }
    };

    $rootScope.updateOnlyOrderApply = function(data){
        
        var promise = $projectAPIService.updateOrder(data);

        promise.then(function(data){
            console.log(data)
            cfpLoadingBar.complete();
            snackbar.create('Ordem atualizada com sucesso!');
        }, function(dataError){
            cfpLoadingBar.complete();
            console.log(dataError);
            snackbar.create('Houve um erro ao atualizar a ordem!');
        });
    };

    $rootScope.editImage = function(data){
        cfpLoadingBar.start();
        var promise = $projectAPIService.getEditImage(data)

        promise.then(function(data){
            cfpLoadingBar.complete();
            $rootScope.img = data.data.data;
        },function(dataError){
            cfpLoadingBar.complete();
            console.log(dataError);
            snackbar.create('Houve um erro ao realizar a busca!')
        })
    };

    $rootScope.deleteImage = function(data){
        cfpLoadingBar.start();
        var promise = $projectAPIService.getDeleteImage(data);

        promise.then(function(data){
            delete $rootScope.img;
            delete $rootScope.codImg;
            cfpLoadingBar.complete();
            snackbar.create('Imagem excluida com sucesso!');
            $rootScope.project = data.data.data;
            $rootScope.uploadLength = data.data.data.upload.data.length;
        }, function(dataError){
            cfpLoadingBar.complete();
            console.log(dataError);
            snackbar.create('Houve um erro ao excluir a imagem!');
        })
    };

    $rootScope.addImage = function(){

        if(!$rootScope.project.id){
            return snackbar.create('Selecione um projeto!');
        };
        var ext = $rootScope.project.file[0].name.match(/\.(.+)$/)[1];

        if(angular.lowercase(ext) ==='jpg' || angular.lowercase(ext) ==='jpeg' || angular.lowercase(ext) ==='png'){
            cfpLoadingBar.start();
            var promise = $projectAPIService.addImage($rootScope.project);
            promise.then(function(data){
                $projectVerifyAPIService.verifyDataImage(data);
            }, function(dataError){
                cfpLoadingBar.complete();
                snackbar.create('Houve um erro ao inserir a imagem!');
                console.log(dataError);
            });
        }  
        else{
            snackbar.create('Serão aceitas apenas imagens no formato .jpeg, .jpg e .png!');
        }


    };

    $rootScope.fillImage = function(data){
        $rootScope.codImg = data;
        $rootScope.img = data;
    };

    $rootScope.clear = function(){
        delete $rootScope.project;
        delete $rootScope.cod;
    }

    $rootScope.clearImage = function(){
        delete $rootScope.cod;
        delete $rootScope.codImg;
        delete $rootScope.img;
        $rootScope.containerImg = false;
    }


}])