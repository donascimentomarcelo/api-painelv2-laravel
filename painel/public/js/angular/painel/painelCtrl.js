angular.module('painel', ['cfp.loadingBar', 'angular.snackbar','googlechart'])
.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
    cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Carregando...</div>';
}])
.controller('ctrlPainel', [  '$rootScope','$http','cfpLoadingBar', 'snackbar',
	function($rootScope,$http,cfpLoadingBar, snackbar){

 $rootScope.myChartObject = {};
    
    $rootScope.myChartObject.type = "BarChart";
    
    $rootScope.onions = [
        {v: "Onions"},
        {v: 3},
    ];

    $rootScope.myChartObject.data = {"cols": [
        {id: "t", label: "Topping", type: "string"},
        {id: "s", label: "Slices", type: "number"}
    ], "rows": [
        {c: [
            {v: "Mushrooms"},
            {v: 3},
        ]},
        {c: $rootScope.onions},
        {c: [
            {v: "Olives"},
            {v: 31}
        ]},
        {c: [
            {v: "Zucchini"},
            {v: 1},
        ]},
        {c: [
            {v: "Pepperoni"},
            {v: 2},
        ]}
    ]};

    $rootScope.myChartObject.options = {
        'title': 'How Much Pizza I Ate Last Night'
    };
}])