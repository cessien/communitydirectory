var npcCommunityApp = angular.module('npccommunity', ['ngAnimate']);

npcCommunityApp.run(function($rootScope) {
   $rootScope.$on('$viewContentLoaded', function() {
      $templateCache.removeAll();
   });
});

/* Small script to live adjust the expanding and collapsing  of people */
window.resizePeople = function(){
    $('.people-header > img').each(function(){
        var height = (300 - this.offsetHeight);
        $(this).css('margin-bottom',height+'px');
        //css('margin-bottom',300 - $(this).height() + 'px');
    });
}


npcCommunityApp.controller('main-controller',['$scope','$http','$compile', function($scope,$http,$compile) {
    $scope.person = {}; 
    $scope.fam = {};
    $scope.communities = [];
    $scope.currentStep = "person";
    $scope.increment = 1;
    $scope.actions = {
        person: ['name','profile-picture','age-sex','location-info','contact-info'],
        family: [],
        community: []
    };
    
    /* load the first page */
    $http({
        method: 'Get',
        url: window.path + 'view.php'
    }).success(function(data){
        $('#main-view').html(data);
        $compile($('#main-view').contents());
        $scope.$broadcast('init',{compiler:$compile($('#main-view').contents())});
    });
    
    
    $scope.increment_count = function(){
        $scope.increment++;
        $scope.remaining = angular.element('#main-view>article').length - 1 - $scope.increment;
    }
    
        /* Submit all forms on the current view */
    $scope.submitAll = function(step){
        var config = {
        };
        
        if ($scope.currentStep == "person") {
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
            config.zipcode = $scope.person.zipcode;
            config.primary_email = $scope.person.primary_email;
            config.primary_phone = $scope.person.primary_phone;
            config.member = $scope.person.member;
        
        } else if ($scope.currentStep == "family") {
            config.action = $scope.fam.action;
            config.uid = $scope.fam.uid;
            config.name = $scope.fam.name;
            config.primary_email = $scope.fam.primary_email;
            config.secondary_email = $scope.fam.secondary_email;
            config.phone_number1 = $scope.fam.phone_number1;
            config.phone_number2 = $scope.fam.phone_number2;
            config.phone_number3 = $scope.fam.phone_number3;
            config.address_line1 = $scope.fam.address_line1;
            config.address_line2 = $scope.fam.address_line2;
            config.city = $scope.fam.city;
        } else if ($scope.currentStep == "communities") {
        }
        
        $http({
            method: 'POST',
            url: window.path + 'save.php?action=all&type='+$scope.currentStep,
            data: $.param(config),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(data){
            console.log(data);
            
            /* transition to the next page */
            $scope.paginate(step);
        });
    }
    
    /* take the current page and transition to the next or previous page */
    $scope.paginate = function(step) {
        if(step && step == "next"){
            /* automatically set up the next step */
            if ($scope.currentStep == "person") {
                $scope.currentStep = "family";
            } else if ($scope.currentStep == "family") {
                $scope.currentStep = "communities";
            } else if ($scope.currentStep == "communities") {
                $scope.currentStep = "end";
            } else if ($scope.currentStep == "end") {
                $scope.currentStep = "end"
            }
        } else if (step && step == "prev") {
            /* automatically set up the previous step */
            if ($scope.currentStep == "person") {
                $scope.currentStep = "person";
            } else if ($scope.currentStep == "family") {
                $scope.currentStep = "person";
            } else if ($scope.currentStep == "communities") {
                $scope.currentStep = "family";
            } else if ($scope,currentStep == "end") {
                $scope.currentStep = "communities";
            }
        } else {
            $scope.currentStep = step;
        }
        
        /* call the next page */
        $http({
            method: 'Get',
            url: window.path + 'view.php?step='+$scope.currentStep
        }).success(function(data){
            $('#main-view').html(data);
            $scope.$broadcast('init',{compiler:$compile($('#main-view').contents())});
        });
    }    
}]);

npcCommunityApp.controller('view-controller',['$scope','$http','$compile', function($scope,$http,$comple) {
    $scope.$on('init',function(info,args){
        $scope.remaining = angular.element('#main-view>article').length - 1;
        args.compiler($scope);
        $scope.index_count = 0; //The global index for the current wizard step
        /* Toggle all the elements to off besides the first item */
        //$(".container > div#main-view > article:not(:first-child)").toggle();

        /* enable collapsing on headers */
        $(".section > h2").click(function(){
            $(this.parentNode).children(":not(h2)").toggle("slow");
        });
    });
    
    $scope.next = function(step,scroll){
        $scope.index_count = (step)?step-1:Math.min($scope.index_count + 1,$(".container > div#main-view > article").size());
        
        var next_element = $(".container > div#main-view > article")[$scope.index_count];
        $(next_element).fadeIn(1000,function(){
            if(scroll) {
                //$('body,html').animate({scrollTop: $(next_element).offset().top}, 500);
                
                //collapse the header for the previous section
                $($(".container > div#main-view > article")[$scope.index_count - 1]).find(".section").children(":not(h2)").toggle("slow");
                
                //Submit the form's data
                $scope.submit(step-1);
            }  
        }); 
    }
    
    $scope.upload = function(){
        var fd = new FormData();
        fd.append('profile_picture',$('#profile_picture')[0].files[0]);
        $http.post((window.path + 'image-upload.php'),fd,{headers: {'Content-Type': undefined}, transformRequest: angular.identity})
        .success(function(data){
            $scope.person.profile_picture = data.trim();
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
            var elem = $($(".container > div#main-view > article")[$scope.index_count - 1]);
            elem.find(".glyphicon-ok > p").text(data);
            elem.find(".section").addClass("saved");
        });
    }
}]);

npcCommunityApp.controller('family-search',['$scope','$http','$compile', function($scope,$http,$compile) {
    $scope.list = [];
    $scope.fuzzy = [];
    //$scope.family = {};
    //$scope.family.active = false; // Flag to show the search results or not. Save space.
    
    $scope.setFamily = function(uid) {
        $scope.family.active = true;
        
        //If a uid is passed then default information to the family record
        if(uid) {
            $scope.fam.action = "update";
            $scope.fam.uid = uid;
            $scope.fam.name = $scope.list[uid][0].name;
            
            $http({
                method: 'POST',
                url: window.path + 'search.php?action=family&fam='+uid,
                header: {
                    'Content-type': "application/json"
                }
            }).success(function(data){
                console.log("success!");
                $scope.family_record = data[0];
                $scope.fam.address_line1 = $scope.family_record.address_line1;
                $scope.fam.address_line2 = $scope.family_record.address_line2;
                $scope.fam.city = $scope.family_record.city;
                $scope.fam.state = "ma";//($scope.family_record.address_line1 != "")?$scope.family_record.address_line1:$scope.person.address_line1;
                $scope.fam.zipcode = $scope.family_record.zipcode;
                
                $scope.fam.primary_phone = ($scope.family_record.primary_phone != "")?$scope.family_record.primary_phone:$scope.person.primary_phone;
                $scope.fam.primary_email = ($scope.family_record.primary_email != "")?$scope.family_record.primary_email:$scope.person.primary_email;
                
            });
            
            
        } else {
            $scope.fam.action = "create";
            $scope.fam.name = $scope.keywords;
            
            $scope.fam.address_line1 = $scope.person.address_line1;
            $scope.fam.address_line2 = $scope.person.address_line2;
            $scope.fam.city = $scope.person.city;
            $scope.fam.state = "ma";
            $scope.fam.zipcode = $scope.person.zipcode;
            
            $scope.fam.primary_phone = $scope.person.primary_phone;
            $scope.fam.primary_email = $scope.person.primary_email;
        }
    }
    
    $scope.filterfn = function(item){
        if(!item){ //skip undefined item indexes
            return false;
        }
        var bFuzzy = false;
        for (var i in $scope.fuzzy) {
            if(parseInt(item[0].uid)==parseInt($scope.fuzzy[i].uid)){
                bFuzzy = true;
                break;
            }
        }
        if(!$scope.keywords || $scope.keywords == "" || (item[0].name).indexOf($scope.keywords) > -1 || bFuzzy) {
            return true;
        } 
        
        return false;
    }
    
    $http({
        method: 'GET',
        url: window.path + 'search.php?action=init',
        header: {
            'Content-type': "application/json"
        }
    }).success(function(data){
        //Separate all family records by family UID - O(n) complexity
        var a = 0;
        for (var i in data) {
            if(!$scope.list[""+data[i].uid])
                $scope.list[""+data[i].uid] = [];
            $scope.list[""+data[i].uid].push(data[i]);
        }
    });
        
    $scope.search = function(){
        if($scope.family.active == true){
            $scope.family.active = false;
        }
        
        $http({
            method: 'POST',
            url: window.path + 'search.php?action=family',
            data: {'keywords': $scope.keywords},
            header: {
                'Content-type': "application/json"
            }
        }).success(function(data){
            $scope.fuzzy = data;
        });
    }
}]);

npcCommunityApp.controller('people-view',['$scope','$http','$compile', function($scope,$http,$compile) {
    $scope.list = [];
    $scope.fuzzy = [];
    
    $scope.filterfn = function(item){
        if(!item){ //skip undefined item indexes
            return false;
        }
        var bFuzzy = false;
        for (var i in $scope.fuzzy) {
            if(parseInt(item[0].uid)==parseInt($scope.fuzzy[i].uid)){
                bFuzzy = true;
                break;
            }
        }
        if(!$scope.keywords || $scope.keywords == "" || (item[0].name).indexOf($scope.keywords) > -1 || bFuzzy) {
            return true;
        } 
        
        return false;
    }
    
    $http({
        method: 'GET',
        url: window.path + 'search.php?action=init-people',
        header: {
            'Content-type': "application/json"
        }
    }).success(function(data){
        //Separate all family records by family UID - O(n) complexity
        var a = 0;
        for (var i in data) {
            if(!$scope.list[""+data[i].family_uid])
                $scope.list[""+data[i].family_uid] = [];
            if(data[i].profile_picture == "")
                data[i].profile_picture = "profile_default.png";
            
            $scope.list[""+data[i].family_uid].push(data[i]);
        }
    });
        
    $scope.search = function(){
        $http({
            method: 'POST',
            url: window.path + 'search.php?action=people',
            data: {'keywords': $scope.keywords},
            header: {
                'Content-type': "application/json"
            }
        }).success(function(data){
            $scope.fuzzy = data;
        });
    }
}]);

npcCommunityApp.directive(
    "repeatComplete",
    function( $rootScope ) {
        var uuid = 0;

        function compile( tElement, tAttributes ) {
            var id = ++uuid;
            tElement.attr( "repeat-complete-id", id );
            tElement.removeAttr( "repeat-complete" );
            var completeExpression = tAttributes.repeatComplete;
            var parent = tElement.parent();
            var parentScope = ( parent.scope() || $rootScope );
            var unbindWatcher = parentScope.$watch(
                function() {

                    console.info( "Digest running." );
                    var lastItem = parent.children( "*[ repeat-complete-id = '" + id + "' ]:last" );
                    if ( ! lastItem.length ) {
                        return;
                    }
                    var itemScope = lastItem.scope();
                    if ( itemScope.$last ) {
                        unbindWatcher();
                        itemScope.$eval( completeExpression );
                    }
                }
            );
        }

        return({
            compile: compile,
            priority: 1001,
            restrict: "A"
        });
    }
);