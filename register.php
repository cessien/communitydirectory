<?php
$dir = plugin_dir_url(__FILE__);//"/wordpress/wp-content/plugins/npcdirectory/";
global $current_user;
global $wpdb;
$user_info = get_currentuserinfo();
$_SESSION['person'] = array();
?>
<!DOCTYPE html>
<html lang="en" ng-app="npccommunity">
    <head>
        <title>Hey there, <?php echo $current_user->user_login?>!</title>
        <script>window.path = "<?php echo $dir?>"</script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" media="all" rel="stylesheet" href="<?php echo $dir;?>css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.2/css/jasny-bootstrap.min.css">
        <link type="text/css" media="all" rel="stylesheet" href="<?php echo $dir;?>css/npccommunity.css">
    </head>
    <body ng-controller="main-controller">
        <section class="jumbotron text-center">
            <h1>Signing up: <span style="text-transform: uppercase;"><?php if($current_user->user_login !="") echo $current_user->user_login?></span><br ><small>Let's start with some basic info about yourself.</small></h1>
        </section>
        <section class="container">
            <article>
                <form class="form-group" ng-submit="submit(1)">
                    <div class="row">
                        <h1 class="col-sm-12 text-center">Who are you?</h1>
                    </div>
                    <div class="row section">
                        <h2 class="col-sm-12"><span class="glyphicon glyphicon-minus" style="font-size: 22px;"></span>&nbsp;Your name?<span class="glyphicon glyphicon-ok" style="font-size: 22px; float: right;"><p style="font-family: 'open sans condensed'; font-size: 30px; display: inline-block">Saved</p></span></h2>
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

            <article>
                <form class="form-group" ng-mouseover="next(3)">
                    <div class="row section" data-provides="fileinput">
                        <h2 class="col-sm-12"><span class="glyphicon glyphicon-minus" style="font-size: 22px;"></span>&nbsp;Do you want to take or upload a profile picture now?<br><small>You can always upload one later, from home.</small><span class="glyphicon glyphicon-ok" style="font-size: 22px; float: right;"><p style="font-family: 'open sans condensed'; font-size: 30px; display: inline-block">Saved</p></span></h2>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <h3>Upload a picture</h3>
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 180px; height: 180px;"></div>
                                <h3><em>Charles Essien</em></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group input-group-lg" ng-focus="next(3)" blur="next(3,true)">
                                    <span class="btn btn-primary btn-lg btn-file">Select image<input type="file" name="..."></span>
                                    <a href="#" class="btn btn-default btn-lg fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-default btn-lg" ng-click="next(3,true)" style="float:right;">Not now</button>
                            </div>
                        </div>
                    </div>
                </form>
            </article>

            <article>
                <form class="form-group">
                    <div class="row section">
                        <h2 class="col-sm-12"><span class="glyphicon glyphicon-minus" style="font-size: 22px;"></span>&nbsp;How old are you?<span class="glyphicon glyphicon-ok" style="font-size: 22px; float: right;"><p style="font-family: 'open sans condensed'; font-size: 30px; display: inline-block">Saved</p></span></h2>
                        <div class="col-sm-12 col-md-3">
                            <div class="input-group input-group-lg">
                                <h3>Birth Date</h3>
                                <input class="form-control" type="text" name="birthday" placeholder="Date of birth" ng-focus="next(4)">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <h3>Are you male or female?</h3>
                            <div class="row input-group input-group-lg" blur="next(4,true)">
                                <div class="col-md-6">
                                    <h3>Male</h3>
                                    <input class="form-control" type="radio" name="sex" value="male" ng-click="next(4,true)">
                                </div>
                                <div class="col-md-6">
                                    <h3>Female</h3>
                                    <input class="form-control" type="radio" name="sex" value="female" ng-click="next(4,true)">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </article>

            <article>
                <form class="form-group">
                    <div class="row section">
                        <h2 class="col-sm-12"><span class="glyphicon glyphicon-minus" style="font-size: 22px;"></span>&nbsp;Where do you live?<span class="glyphicon glyphicon-ok" style="font-size: 22px; float: right;"><p style="font-family: 'open sans condensed'; font-size: 30px; display: inline-block">Saved</p></span></h2>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group input-group input-group-lg">
                                <h3>Line 1</h3>
                                <input type="text" placeholder="Address Line 1" class="form-control">
                                <h3>Line 2</h3>
                                <input type="text" placeholder="Address Line 2" class="form-control">
                                <h3>City</h3>
                                <input type="text" placeholder="City" class="form-control" ng-focus="next(5)">
                                <div class="row">
                                    <div class="col-sm-8 col-md-6">
                                        <div class="input-group input-group-lg">
                                            <h3>Zip</h3>
                                            <input type="text" placeholder="Zip" class="form-control" ng-focus="next(5)" ng-blur="next(5,true)">
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

            <article>
                <form class="form-group">
                    <div class="row section">
                        <h2 class="col-sm-12"><span class="glyphicon glyphicon-minus" style="font-size: 22px;"></span>&nbsp;How can we contact you?<br><small>The reasons we may contact you may vary depending on whether you volunteer or not, and how active you are in the church. Your privacy matter to us and we would never share your contact information with anyone outside of NPC staff.</small><span class="glyphicon glyphicon-ok" style="font-size: 22px; float: right;"><p style="font-family: 'open sans condensed'; font-size: 30px; display: inline-block">Saved</p></span></h2>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group input-group input-group-lg">
                                <h3>Primary email</h3>
                                <input type="text" placeholder="Email address" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group input-group input-group-lg">
                                <h3>Primary phone number</h3>
                                <input type="text" placeholder="Phone number" class="form-control"  name="email">
                            </div>
                        </div>
                    </div>
                </form>
            </article>
            <div class="row navigation">
                <div class="col-sm-6">
                    <h1 class="previous"><a>&lt; Previous</a></h1>
                </div>
                <div class="col-sm-6">
                    <h1 class="next"><a>Continue &gt;</a></h1>
                </div>
            </div>
        </section><!-- end container -->
        <script src="<?php echo $dir;?>js/jquery.min.js"></script>
        <script src="<?php echo $dir;?>js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.2/js/jasny-bootstrap.min.js"></script>
        <script src="<?php echo $dir;?>js/angular.min.js"></script>
        <script src="<?php echo $dir;?>js/angular-route.min.js"></script>
        <script src="<?php echo $dir;?>js/angular-animate.min.js"></script>
        <script src="<?php echo $dir;?>js/npccommunity.js"></script>
    </body>
</html>