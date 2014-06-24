<?php
if(!session_id()) {
    session_start();
}

$dir = "/wordpress/wp-content/plugins/npcdirectory/";
$upload_dir = "/wordpress/wp-content/uploads/profile/";
global $family_user;
$user_info = get_currentuserinfo();
?>
<?php include("header.php"); ?>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 col-sm-12">
                    <article ng-controller="family-view">
                        <div class="form-group">
                            <div class="row section search">
                                <h2 class="col-sm-12">Families in NPC</h2>
                                <div class="input-group input-group-lg col-sm-12">
                                    <input type="text" class="search-query form-control" ng-model="keywords" ng-click="family.active = false" ng-keyup="search()" placeholder="Search for families by last name">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" ng-keyup="search()" title="Search">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="row text-left actions">
                                <div class="col-md-2"><a ng-click="selectAll()" href><h2><span class="glyphicon glyphicon-ok"></span> Select all</h2></a></div>
                                <div class="col-md-3"><a ng-click="email()" href><h2><span class="glyphicon glyphicon-envelope"></span> Email selected</h2></a></div>
                                <div class="col-md-4"><a ng-click="listNumbers()" href><h2><span class="glyphicon glyphicon-earphone"></span> Selected phone numbers</h2></a></div>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-5 text-left actions">
                                    <h2>Viewing ({{mode}}):</h2>
                                    <a ng-click="mode='images'"><h2><span class="glyphicon glyphicon-th"></span> Images</h2></a>
                                    <a ng-click="mode='list'"><h2><span class="glyphicon glyphicon-th-list"></span> List</h2></a>
                                </div>
                            </div>
                            <div class="row section search">
                                <div class="col-sm-12">
                                    <div id="families" class="results row">
                                        <div class="col-md-4" ng-repeat="family in list | filter: filterfn">
                                            <div class="family-header" ng-click="family.selected = (family.selected)?false:true">
                                                <img src="<?php echo $dir;?>img/default-profile.png" class="img-responsive" alt="Responsive image"/>
                                                <div class="information">
                                                    <h2 ng-click="showModal(family.uid)">
                                                        <div class="selected" ng-show="family.selected" ng-click="family.selected = false"><h2><span class="glyphicon glyphicon-ok"></h2></div>
                                                        <strong>{{family.name}}</strong>
                                                    </h2>
                                                    <div>
                                                        <h3><strong>{{family.city}},&nbsp;{{family.state}}</strong></h3>
                                                        <h3><span ng-repeat="person in family.members">{{person}}{{$last ? '' : ', '}}</span></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Family details modal -->
                        <div id="family-modal" class="modal fade">
                            <div class="modal-dialog">
                                <article class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <img ng-src="<?php echo $upload_dir;?>{{selection.profile_picture}}" width=70 alt="Responsive image"/>
                                        <div>
                                            <h2 class="modal-title">{{selection.header}}</h2>
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
                                            <tr><td><p>Members:</p></td>
                                                <td>
                                                    <p ng-repeat="person in selection.members"><strong>{{person}}</strong></p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
                                            <tr><th>Family</th><th>Email addresses</th></tr>
                                            <tr ng-repeat="family in list" ng-show="family.selected == true && family.primary_email != ''"><td><p>{{family.name}}</p></td><td><p><strong>{{family.primary_email}}</strong></p><p ng-show="family.secondary_email != ''" class="secondary">{{family.secondary_email}}</p></td><td><a ng-href="mailto:{{family.primary_email}}"><span class="glyphicon glyphicon-envelope"></span></a></td></tr>
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
                                            <tr><th>Family</th><th>Phone numbers</th></tr>
                                            <tr ng-repeat="family in list" ng-show="family.selected == true && family.primary_phone != ''"><td><p>{{family.name}}</p></td><td><p><strong>{{family.primary_phone}}</strong></p><p ng-show="family.secondary_phone != ''" class="secondary">{{family.secondary_phone}}</p></td></tr>
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