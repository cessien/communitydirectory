<?php
if(!session_id()) {
    session_start();
}

$dir = "/wordpress/wp-content/plugins/npcdirectory/";
global $current_user;
$user_info = get_currentuserinfo();

$_SESSION["current_step"] = "person"; //The current step of the wizard. 1 - person, 2 - family, 3 - community
?>
<?php include("header.php"); ?>
            <div class="row">
                <div class="col-md-3 col-sm-1">
                    <ul class="nav side-nav primary" >
                        <li ng-class="{active: currentStep=='person'}"><a>You</a>
                            <ul class="nav secondary">
                                <li ng-class="{active: currentStep=='person' && increment==1}"><a>Your name</a></li>
                                <li ng-class="{active: currentStep=='person' && increment==2}"><a>Profile picture</a></li>
                                <li ng-class="{active: currentStep=='person' && increment==3}"><a>Age</a></li>
                                <li ng-class="{active: currentStep=='person' && increment==4}"><a>Location</a></li>
                                <li ng-class="{active: currentStep=='person' && increment==5}"><a>Contact information</a></li>
                            </ul>
                        </li>
                        <li ng-class="{active: currentStep=='family'}"><a>Your Family</a>
                            <ul class="nav secondary">
                                <li><a>Find your family</a></li>
                                <li><a>Update or add information</a></li>
                                <li><a>Family relationship</a></li>
                            </ul>
                        </li>
                        <li ng-class="{active: currentStep=='communities'}"><a>Your Communites</a>
                            <ul class="nav secondary">
                                <li><a>How are you involved?</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 col-sm-11">
                <div id="main-view" ng-controller="view-controller"></div>
                
                <div class="loader col-sm-12 text-center" ng-click="increment_count()" ng-show="remaining > 0" ng-init="remaining = (currentStep != 'family')?4:1">
                    <h3><span><span class="glyphicon glyphicon-arrow-down"></span>{{remaining}} Remaining</span>Load more.</h3>
                </div>
                </div>
            </div>
            <div class="row navigation">
                <div class="col-sm-6">
                    <h1 class="previous"><a ng-href="#" ng-click="paginate('prev')">&lt; Previous</a></h1>
                </div>
                <div class="col-sm-6">
                    <h1 class="next" ><a ng-href="#" ng-click="submitAll('next')">Continue &gt;</a></h1>
                </div>
            </div>
<?php include("footer.php"); ?>