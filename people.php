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
                <div class="col-md-offset-3 col-sm-offset-1"></div>
                <div class="col-md-9 col-sm-11">
                    <article ng-controller="people-view">
                        <div class="form-group">
                            <div class="row section search">
                                <h2 class="col-sm-12">People in NPC</h2>
                                <div class="input-group input-group-lg col-sm-12">
                                    <input type="text" class="search-query form-control" ng-model="keywords" ng-click="family.active = false" ng-keyup="search()" placeholder="Search for families by last name">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" ng-keyup="search()" title="Search">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </span>
                                </div>
                                <div class="col-sm-12">
                                    <div class="results row">
                                        <div class="col-md-4" ng-repeat="family in list | filter: filterfn">
                                            <div class="family-header" >
                                                <div ng-repeat="person in family">
                                                    <img ng-src="<?php echo $upload_dir;?>/{{person.profile_picture}}" class="img-responsive" alt="Responsive image"/>
                                                </div>
                                                <div class="information">
                                                    <h2>{{family[0].name}}</h2>
                                                    <div>
                                                        <h3><strong>{{family[0].city}},&nbsp;{{family[0].state}}</strong></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
<?php include("footer.php"); ?>