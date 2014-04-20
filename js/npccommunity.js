var npcCommunityApp = angular.module('npccommunity', ['ngRoute','ngAnimate']);

npcCommunityApp.controller('mainController',['$sce', function($scope,$sce) {
    avvv=$sce;
    $scope.message = '!'+Math.random();
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