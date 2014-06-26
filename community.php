<?php
if(!session_id()) {
    session_start();
}

$dir = "/wordpress/wp-content/plugins/npcdirectory/";
$upload_dir = "/wordpress/wp-content/uploads/profile/";
global $current_user;
$user_info = get_currentuserinfo();
?>
<?php include("header.php"); ?>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 col-sm-12" ng-controller="community-view">
                    <article>
                        <div class="form-group">
                            <div class="row section search">
                                <h2 class="col-sm-12">Communities in NPC</h2>
                                <div class="input-group input-group-lg col-sm-12">
                                    <input type="text" class="search-query form-control" ng-model="keywords" ng-keyup="search()" placeholder="Search for communities">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" ng-keyup="search()" title="Search">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--<ul>
                            <li ng-repeat="(community,data) in list"><h2>{{community}}</h2>
                                <ul ng-repeat="(role,roleData) in list[community]"><li ng-repeat="person in list[community][role]">{{person.first_name}}</li></ul>
                            </li>
                        </ul>-->
                    </article>
                    <article ng-repeat="(community,data) in list">
                        <h2>{{community}}</h2>
                        <div class="row">
                            <span class="col-md-2">
                                <ul class="nav">
                                    <li class="active"><a href="#desc-{{$index}}" data-toggle="tab">Description</a></li>
                                    <li><a ng-href="#all-{{$index}}" data-toggle="tab">All participants</a></li>
                                    <li><a ng-href="#leaders-{{$index}}" data-toggle="tab">Leaders</a></li>
                                    <li><a ng-href="#volunteers-{{$index}}" data-toggle="tab">Volunteers</a></li>
                                    <li><a ng-href="#attendees-{{$index}}" data-toggle="tab">Attendees</a></li>
                                </ul>
                            </span>
                            <div class="tab-content col-md-10">
                                <div id="desc-{{$index}}" class="tab-pane active"><h3>Description</h3>
                                    <p class="secondary">{{data['attendee'][0].description}}</p>
                                </div>
                                <div id="all-{{$index}}" class="tab-pane">
                                    <h3>All Members</h3>
                                    <table class="table">
                                        <tr><th>Name</th><th>Number</th><th>Email</th></tr>
                                        <tr ng-repeat="person in communityList[community] | filter: uniqueFilter">
                                            <td>{{person.first_name}} {{person.last_name}}</td>
                                            <td>{{person.primary_number}}</td>
                                            <td>{{person.primary_email}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="leaders-{{$index}}" class="tab-pane">
                                    <h3>Leaders</h3>
                                    <table class="table">
                                        <tr><th>Name</th><th>Number</th><th>Email</th></tr>
                                        <tr ng-repeat="person in list[community]['leader']">
                                            <td>{{person.first_name}} {{person.last_name}}</td>
                                            <td>{{person.primary_number}}</td>
                                            <td>{{person.primary_email}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="volunteers-{{$index}}" class="tab-pane">
                                    <h3>Volunteers</h3>
                                    <table class="table">
                                        <tr><th>Name</th><th>Number</th><th>Email</th></tr>
                                        <tr ng-repeat="person in list[community]['volunteer']">
                                            <td>{{person.first_name}} {{person.last_name}}</td>
                                            <td>{{person.primary_number}}</td>
                                            <td>{{person.primary_email}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="attendees-{{$index}}" class="tab-pane">
                                    <h3>Attendees</h3>
                                    <table class="table">
                                        <tr><th>Name</th><th>Number</th><th>Email</th></tr>
                                        <tr ng-repeat="person in list[community]['attendee']">
                                            <td>{{person.first_name}} {{person.last_name}}</td>
                                            <td>{{person.primary_number}}</td>
                                            <td>{{person.primary_email}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
                        
<?php include("footer.php"); ?>