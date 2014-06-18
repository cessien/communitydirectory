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
                <div class="col-md-10 col-sm-12">
                    <article ng-controller="community-view">
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
                            <div class="row section search">
                                <div class="col-sm-12">
                                    <div id="people" class="results row" ng-show="mode=='images'">
                                        <div class="col-md-4" ng-repeat="family in list | filter: filterfn">
                                            
                                        </div>
                                    </div>
                                        <div id="people" class="results" ng-show="mode=='list'">
                                            <div ng-repeat="family in list | filter: filterfn">
                                                <div class="row" ng-repeat="person in family">
                                                </div>
                                            </div>
                                            
                                        </div>
                                </div>
                            </div>
                        </div>
                            
                        <!-- detailed person view modal-->
                        <div id="people-modal" class="modal fade">
                            <div class="modal-dialog">
                                <article class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <img ng-src="<?php echo $upload_dir;?>{{selection.profile_picture}}" width=70 alt="Responsive image"/>
                                        <div>
                                            <h2 class="modal-title">{{selection.header}}</h2>
                                            <h3>{{selection.header2}}</h3>
                                        </div>
                                    </div>
                                    <div class="modal-body information">
                                        <table class="table">
                                            <tr><td><p>Email:</p></td><td><p><strong>{{selection.primary_email}}</strong></p></td></tr>
                                            <tr ng-show="selection.secondary_email != ''"><td></td><td class="secondary"><p><strong>{{selection.secondary_email}}</strong></p></td></tr>
                                            <tr><td><p>Phone:</p></td><td><p><strong>{{selection.primary_phone}}</strong></p></td></tr>
                                            <tr ng-show="selection.secondary_phone != ''"><td></td><td class="secondary"><p><strong>{{selection.secondary_phone}}</strong></p></td></tr>
                                            <tr><td><p>Address:</p></td>
                                                <td>
                                                    <p><strong>{{selection.address_line1}}</strong></p>
                                                    <p class="secondary">{{selection.address_line2}}</p>
                                                    <p class="secondary">{{selection.city}} {{selection.state}}, {{selection.zipcode}}</p>
                                                </td>
                                            </tr>
                                            <tr><td><p>Age:</p></td>
                                                <td>
                                                    <p><strong>{{selection.age}}</strong><span class="secondary"> ({{selection.birthday}})</span></p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-lg btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </article><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                            
                        <!-- emails modal-->
                        <div id="email-modal" class="modal fade">
                            <div class="modal-dialog">
                                <article class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <div>
                                            <h2 class="modal-title">Email addresses</h2>
                                        </div>
                                    </div>
                                    <div class="modal-body information">
                                        <form class="form-group">
                                            <h2>Copy and paste this text field into an email</h2>
                                            <div class="input-group input-group-lg">
                                                <textarea ng-model="emailList" style="width: 500px; height 200px;"></textarea>
                                            </div>
                                        </form>
                                        <table class="table" >
                                            <tr ng-repeat-start="family in list" ng-show="$index == 1"><th>Name</th><th>Email addresses</th></tr>
                                            <tr ng-repeat="current in family" ng-show="current.selected == true && current.primary_email != ''"><td><p>{{current.first_name}} {{current.last_name}}</p></td><td><p><strong>{{current.primary_email}}</strong></p><p ng-show="current.secondary_email != ''" class="secondary">{{current.secondary_email}}</p></td><td><a ng-href="mailto:{{current.primary_email}}"><span class="glyphicon glyphicon-envelope"></span></a></td></tr>
                                            <tr ng-repeat-end></tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-lg btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </article><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                            
                        <!-- phone numbers modal-->
                        <div id="numbers-modal" class="modal fade">
                            <div class="modal-dialog">
                                <article class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <div>
                                            <h2 class="modal-title">Phone numbers</h2>
                                        </div>
                                    </div>
                                    <div class="modal-body information">
                                        <table class="table" >
                                            <tr ng-repeat-start="family in list" ng-show="$index == 1"><th>Name</th><th>Phone numbers</th></tr>
                                            <tr ng-repeat="current in family" ng-show="current.selected == true && current.primary_phone != ''"><td><p>{{current.first_name}} {{current.last_name}}</p></td><td><p><strong>{{current.primary_phone}}</strong></p><p ng-show="current.secondary_phone != ''" class="secondary">{{current.secondary_phone}}</p></td></tr>
                                            <tr ng-repeat-end></tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-lg btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </article><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </article>
                </div>
            </div>
                        
<?php include("footer.php"); ?>