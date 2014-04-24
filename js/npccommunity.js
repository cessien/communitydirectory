var npcCommunityApp = angular.module('npccommunity', ['ngRoute','ngAnimate']);

npcCommunityApp.controller('main-controller',['$scope', function($scope,$sce) {
    $scope.index_count = 0; //The global index for the current wizard step
    
    /* Toggle all the elements to off besides the first item */
    $(".container > article:not(:first-child)").toggle();
    $scope.next = function(){
        $scope.index_count = Math.min($scope.index_count + 1,$(".container > article").size());
        var next_element = $(".container > article")[$scope.index_count];
        $(next_element).fadeIn(1000,function(){
            $('body,html').animate({scrollTop: $(next_element).offset().top}, 500);
        }); 
    }
    var count = 0
    /*$(".container > article").each(function(){
        var _this = this;
        setTimeout(function(){
            //$(_this).fadeIn(1000);
        },count*1000);
        count++;
    });*/
}]);

npcCommunityApp.config(function($routeProvider) {
    $routeProvider.when('/', {
            templateUrl : window.path+'view.php?step=next',//?step=next
            controller  : 'mainController'
    })
});

function search($scope, $http, $sce) {
    $scope.url = 'query.php'; // The url of our search

    // The function that will be executed on button click (ng-keyup="search()")
    $scope.search = function() {

        // Create the http post request
        // the data holds the keywords
        // The request is a JSON request.
        $http.post($scope.url, { "data" : $scope.keywords}).
        success(function(data, status) {
            $scope.status = status;
            $scope.data = data;
            $scope.result = $sce.trustAsHtml(data); // Show result from server in our <pre></pre> element
        })
        .
        error(function(data, status) {
            $scope.data = data || "Request failed";
            $scope.status = status;         
        });
    };
}