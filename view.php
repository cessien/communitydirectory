<?php
if(!session_id()) {
    session_start();
}

if (isset($_GET["step"])) {
    $_SESSION["current_step"] = $_GET["step"];
} else {
    $_SESSION["current_step"] = "person";
}

$dir = "/wordpress/wp-content/plugins/npcdirectory/";

if ($_SESSION["current_step"] == "person") { ?>
<article>
    <form class="form-group">
        <div class="row">
            <h1 class="col-sm-12 text-center">Who are you?</h1>
        </div>
    </form>
</article>
<article ng-show="increment >= 1">
    <form class="form-group" ng-submit="submit(1)">
        <div class="row section">
            <h2 class="col-sm-12">What's your name?<span class="glyphicon glyphicon-ok" style="font-size: 22px; float: right;"><p style="font-family: 'open sans condensed'; font-size: 30px; display: inline-block">Saved</p></span></h2>
            <div class="col-sm-2 col-sm-offset-3">
                <div class="input-group input-group-lg">
                    <h3>First name</h3>
                    <input class="form-control input-block-level" type="text" name="first_name" ng-model="person.first_name" placeholder="First name">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group input-group-lg">
                    <h3>Middle name</h3>
                    <input class="form-control" type="text" name="first_name" ng-model="person.middle_name" placeholder="Middle name">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group input-group-lg">
                    <h3>Last name</h3>
                    <input class="form-control" type="text" name="first_name" ng-model="person.last_name" placeholder="Last name" ng-focus="next(2)" ng-blur="next(2,true)">
                </div>
            </div>
        </div>
    </form>
</article>

<article ng-show="increment >= 2">
    <form class="form-group" method="POST" enctype="multipart/form-data" id="profileupload">
        <div class="row section" data-provides="fileinput">
            <h2 class="col-sm-12">Do you want to take or upload a profile picture now?<br><small>You can always upload one later, from home.</small><span class="glyphicon glyphicon-ok" style="font-size: 22px; float: right;"><p style="font-family: 'open sans condensed'; font-size: 30px; display: inline-block">Saved</p></span></h2>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h3>Upload a picture</h3>
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 180px; height: 180px;"></div>
                    <h3><em>{{person.first_name}}</em></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="input-group input-group-lg" ng-focus="next(3)" blur="next(3,true)">
                        <span class="btn btn-primary btn-lg btn-file">Select image<input type="file" name="profile_picture" id="profile_picture"></span>
                        <a href="#" class="btn btn-default btn-lg fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-default btn-lg" ng-click="upload()" style="float:right;">Upload</button>
                </div>
            </div>
        </div>
    </form>
</article>

<article ng-show="increment >= 3">
    <form class="form-group">
        <div class="row section">
            <h2 class="col-sm-12">How old are you?<span class="glyphicon glyphicon-ok" style="font-size: 22px; float: right;"><p style="font-family: 'open sans condensed'; font-size: 30px; display: inline-block">Saved</p></span></h2>
            <div class="col-sm-12 col-md-3">
                <div class="input-group input-group-lg">
                    <h3>Birth Date</h3>
                    <input class="form-control" type="date" name="birthday" ng-model="birthday" ng-focus="next(4)">
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <h3>Are you male or female?</h3>
                <div class="row input-group input-group-lg" blur="next(4,true)">
                    <div class="col-md-6">
                        <h3>Male</h3>
                        <input class="form-control" type="radio" ng-model="person.sex" name="sex" value="1" ng-click="next(4,true)">
                    </div>
                    <div class="col-md-6">
                        <h3>Female</h3>
                        <input class="form-control" type="radio" ng-model="person.sex" name="sex" value="0" ng-click="next(4,true)">
                    </div>
                </div>
            </div>
        </div>
    </form>
</article>

<article ng-show="increment >= 4">
    <form class="form-group">
        <div class="row section">
            <h2 class="col-sm-12">Where do you live?<span class="glyphicon glyphicon-ok" style="font-size: 22px; float: right;"><p style="font-family: 'open sans condensed'; font-size: 30px; display: inline-block">Saved</p></span></h2>
            <div class="col-sm-12 col-md-6">
                <div class="form-group input-group input-group-lg">
                    <h3>Line 1</h3>
                    <input type="text" ng-model="person.address_line1" placeholder="Address Line 1" class="form-control">
                    <h3>Line 2</h3>
                    <input type="text" ng-model="person.address_line2" placeholder="Address Line 2" class="form-control">
                    <h3>City</h3>
                    <input type="text" ng-model="person.city" placeholder="City" class="form-control" ng-focus="next(5)">
                    <div class="row">
                        <div class="col-sm-8 col-md-6">
                            <div class="input-group input-group-lg">
                                <h3>Zip</h3>
                                <input type="text" ng-model="person.zipcode" placeholder="Zip" class="form-control" ng-focus="next(5)" ng-blur="next(5,true)">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-6">
                            <div class="input-group input-group-lg">
                                <h3>State</h3>
                                <select class="form-control" ng-focus="next(5)" blur="next(5,true)">
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA" selected>Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</article>

<article ng-show="increment >= 5">
    <form class="form-group">
        <div class="row section">
            <h2 class="col-sm-12">How can we contact you?<br><small>The reasons we may contact you may vary depending on whether you volunteer or not, and how active you are in the church. Your privacy matter to us and we would never share your contact information with anyone outside of NPC staff.</small><span class="glyphicon glyphicon-ok" style="font-size: 22px; float: right;"><p style="font-family: 'open sans condensed'; font-size: 30px; display: inline-block">Saved</p></span></h2>

            <div class="col-sm-12 col-md-4">
                <div class="form-group input-group input-group-lg">
                    <h3>Primary email</h3>
                    <input type="text" ng-model="person.primary_email" placeholder="Email address" class="form-control" name="email">
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group input-group input-group-lg">
                    <h3>Primary phone number</h3>
                    <input type="text" ng-model="person.primary_phone" placeholder="Phone number" class="form-control"  name="email" ng-blur="next(6,true)">
                </div>
            </div>
        </div>
    </form>
</article>
<?php } else if ($_SESSION['current_step'] == "family") { ?>
<article>
    <form class="form-group" ng-submit="submit(1)">
        <div class="row">
            <h1 class="col-sm-12 text-center">Do you have family at NPC?</h1>
        </div>
        <div class="row section">
            <div class="col-md-offset-3 col-md-3">
                <h1>Yes</h1>
                <input class="form-control" type="radio" ng-model="family.show" name="show" value="yes">
            </div>
            <div class="col-md-3">
                <h1>No</h1>
                <input class="form-control" type="radio" ng-model="family.show" name="show" value="no">
            </div>
        </div>
    </form>
</article>
<div ng-hide="family.show != 'yes'">
    <article ng-controller="family-search">
        <div class="form-group">
            <div class="row section search">
                <h2 class="col-sm-12">Search for your family.</h2>
                <div class="input-group input-group-lg col-sm-12">
                    <input type="text" class="search-query form-control" ng-model="keywords" ng-click="family.active = false" ng-keyup="search()" placeholder="Search for families by last name">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" ng-keyup="search()" title="Search">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                        <button class="btn btn-default" type="button" ng-click="setFamily()" title="Add a new Family">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </span>
                </div>
                <div class="col-sm-12" ng-show="family.active != true">
                    <div class="results row">
                        <div class="col-md-4">
                            <div class="family-header first text-center" ng-click="setFamily()">
                                <h2><a class="col-md-12"><span class="glyphicon glyphicon-plus"></span> Tap here to add a new family.</a></h2>
                                <h2 ng-show="keywords!=''">[ {{keywords}} ]</h2>
                                
                            </div>
                        </div>
                        <div class="col-md-4" data-id="{{family[0].uid}}" ng-repeat="family in list | filter: filterfn" ng-click="setFamily(family[0].uid)">
                            <div class="family-header" >
                                <img src="<?php echo $dir;?>img/default-profile.png" class="img-responsive" alt="Responsive image"/>
                                <div class="information">
                                    <h2>{{family[0].name}}</h2>
                                    <div>
                                        <h3><strong>{{family[0].city}},&nbsp;{{family[0].state}}</strong></h3>
                                        <h3><span ng-repeat="person in family">{{person.first_name}}, </span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <article>
        <div class="form-group">
            <div class="row">
                <h2 class="col-sm-12">Verify or update information for family: {{fam.name}}</h2>
            </div>
            <div class="row" ng-show="fam.action == 'create'">
                <div class="col-sm-12 col-md-8">
                    <div class="form-group input-group input-group-lg">
                        <h3>Family Surname</h3>
                        <input type="text" ng-model="fam.name" placeholder="Family surname (Last name)" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group input-group input-group-lg">
                        <h3>Primary email</h3>
                        <input type="text" ng-model="fam.primary_email" placeholder="Primary email" class="form-control">
                        <h3>Secondary email</h3>
                        <input type="text" ng-model="fam.secondary_email" placeholder="Secondary email" class="form-control">  
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group input-group input-group-lg">
                        <h3>Primary phone</h3>
                        <input type="text" ng-model="fam.primary_phone" placeholder="Primary phone" class="form-control">
                        <h3>Secondary phone</h3>
                        <input type="text" ng-model="fam.secondary_phone" placeholder="Secondary phone" class="form-control">  
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="form-group input-group input-group-lg">
                        <h3>Line 1</h3>
                        <input type="text" ng-model="fam.address_line1" placeholder="Address Line 1" class="form-control">
                        <h3>Line 2</h3>
                        <input type="text" ng-model="fam.address_line2" placeholder="Address Line 2" class="form-control">
                        <h3>City</h3>
                        <input type="text" ng-model="fam.city" placeholder="City" class="form-control">
                        <h3>Zip</h3>
                        <input type="text" ng-model="fam.zipcode" placeholder="Zip" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
        </div>
    </article>
    <article>
        <form class="form-group" ng-submit="submit(1)">
            <div class="row">
                <h2>What's your relationship to this family?</h2>
                <div class="form-group input-group input-group-lg">
                    <select class="form-control" ng-modelng-focus="next(5)" blur="next(5,true)">
                        <option value="parent">Parent / guardian</option>
                        <option value="child">Child</option>
                    </select>
                </div>
            </div>
        </form>
    </article>
</div>
<?php } else if ($_SESSION['current_step'] == "communities") { ?>
<article>
    <form class="form-group" ng-submit="submit(1)">
        <div class="row">
            <h1 class="col-sm-12 text-center">Which NPC communities are you involved with?</h1>
        </div>
    </form>
</article>
<?php } else if ($_SESSION['current_step'] == "end") { ?>
<?php } ?>