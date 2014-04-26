var npcCommunityApp = angular.module('npccommunity', ['ngRoute','ngAnimate']);

npcCommunityApp.controller('main-controller',['$scope','$http', function($scope,$http) {
    $scope.currentStep = "person";
    $scope.actions = {
        person: ['name','profile-picture','age-sex','location-info','contact-info'],
        family: [],
        community: []
    };
    
    $scope.index_count = 0; //The global index for the current wizard step
    
    /* Toggle all the elements to off besides the first item */
    $(".container > article:not(:first-child)").toggle();
    
    /* enable collapsing on headers */
    $(".section > h2").click(function(){
        $(this.parentNode).children(":not(h2)").toggle("slow");
    });
    
    $scope.next = function(step,scroll){
        $scope.index_count = (step)?step-1:Math.min($scope.index_count + 1,$(".container > article").size());
        
        var next_element = $(".container > article")[$scope.index_count];
        $(next_element).fadeIn(1000,function(){
            if(scroll) {
                //$('body,html').animate({scrollTop: $(next_element).offset().top}, 500);
                
                //collapse the header for the previous section
                $($(".container > article")[$scope.index_count - 1]).find(".section").children(":not(h2)").toggle("slow");
                
                //Submit the form's data
                $scope.submit(step-1);
            }  
        }); 
    }
    
    $scope.submit = function(index,type){
        if(!type) type = "person"
        var config = {
        };
        
        if (type=="person"){
            switch(index - 1) {
                    case 0:
                        config.first_name = $scope.person.first_name;
                        config.middle_name = $scope.person.middle_name;
                        config.last_name = $scope.person.last_name;
                    break;
                    case 1:
                        config.profile_picture = $scope.person.profile_picture;
                    break;
                    case 2:
                        config.birthday = $scope.person.birthday;
                        config.sex = $scope.person.sex;
                    break;
            }
        }
        
        
        $http({
            method: 'POST',
            url: window.path + 'save.php?action=' + $scope.actions.person[index - 1],
            data: $.param(config),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(data){
            var elem = $($(".container > article")[$scope.index_count - 1]);
            elem.find(".glyphicon-ok > p").text(data);
            elem.find(".section").addClass("saved");
        });
    }
    
    /* Submit all forms on the current view */
    $scope.submitAll = function(proceedToNextStep){
        var config = {
        };
        
        if ($scope.currentStep = "person") {
            //Submit all the fields for a person
            config.first_name = $scope.person.first_name;
            config.middle_name = $scope.person.middle_name;
            config.last_name = $scope.person.last_name;
            config.birthday = $scope.person.birthday;
            config.sex = $scope.person.sex;
            config.profile_picture = $scope.person.profile_picture;
            config.address_line1 = $scope.person.address_line1;
            config.address_line2 = $scope.person.address_line2;
            config.address_city = $scope.person.city;
            config.state = $scope.person.state;
            config.zip = $scope.person.zip;
            config.primary_email = $scope.person.primary_email;
            config.primary_phone = $scope.person.primary_phone;
            config.member = $scope.person.member;
    
        } else if ($scope.currentStep = "family") {
        } else if ($sope.currentStep = "communities") {
        }
        
        $http({
            method: 'POST',
            url: window.path + 'save.php?action=all&type=person',
            data: $.param(config),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(data){
            alert(data);
        });
    }
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