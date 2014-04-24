<?php
$dir = plugin_dir_url(__FILE__);//"/wordpress/wp-content/plugins/npcdirectory/";
global $current_user;
global $wpdb;
$user_info = get_currentuserinfo();
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
                <form class="form-group">
                    <div class="row">
                        <h1 class="col-sm-12 text-center" ng-click="next()">Who are you?</h1>
                    </div>
                    <div class="row section">
                        <h2 class="col-sm-12"><span class="glyphicon glyphicon-ok" style="font-size: 22px;"></span>&nbsp;Your name?</h2>
                        <div class="col-sm-2 col-sm-offset-3">
                            <div class="input-group input-group-lg">
                                <h3>First name</h3>
                                <input class="form-control input-block-level" type="text" name="first_name" placeholder="First name">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group input-group-lg">
                                <h3>Middle name</h3>
                                <input class="form-control" type="text" name="first_name" placeholder="Middle name">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group input-group-lg">
                                <h3>Last name</h3>
                                <input class="form-control" type="text" name="first_name" placeholder="Last name">
                            </div>
                        </div>
                    </div>
                </form>
            </article>

            <article>
                <form class="form-group">
                    <div class="row">
                        <h2 class="col-sm-12"><span class="glyphicon glyphicon-minus" style="font-size: 22px;"></span>&nbsp;Do you want to take or upload a profile picture now?<br><small>You can always upload one later, from home.</small></h2>
                    </div>
                    <div class="row section" data-provides="fileinput">
                        <div class="col-sm-12 col-md-6">
                            <h3>Upload a picture</h3>
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 180px; height: 180px;"></div>
                            <h3><em>Charles Essien</em></h3>
                            <div class="input-group input-group-lg">
                                <span class="btn btn-primary btn-lg btn-file">Select image<input type="file" name="..."></span>
                                <a href="#" class="btn btn-default btn-lg fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </form>
            </article>

            <article>
                <form class="form-group">
                    <div class="row section">
                        <h2 class="col-sm-12"><span class="glyphicon glyphicon-minus" style="font-size: 22px;"></span>&nbsp;How old are you?</h2>
                        <div class="col-sm-12 col-md-3">
                            <div class="input-group input-group-lg">
                                <h3>Birth Date</h3>
                                <input class="form-control" type="text" name="birthday" placeholder="Date of birth">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <h3>Are you male or female?</h3>
                            <div class="row input-group input-group-lg">
                                <div class="col-md-6">
                                    <h3>Male</h3>
                                    <input class="form-control" type="radio" name="sex" value="male">
                                </div>
                                <div class="col-md-6">
                                    <h3>Female</h3>
                                    <input class="form-control" type="radio" name="sex" value="female">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </article>

            <article>
                <form class="form-group">
                    <div class="row section">
                        <h2 class="col-sm-12"><span class="glyphicon glyphicon-minus" style="font-size: 22px;"></span>&nbsp;Where do you live?</h2>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group input-group input-group-lg">
                                <h3>Line 1</h3>
                                <input type="text" placeholder="Address Line 1" class="form-control">
                                <h3>Line 2</h3>
                                <input type="text" placeholder="Address Line 2" class="form-control">
                                <h3>City</h3>
                                <input type="text" placeholder="City" class="form-control">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="input-group input-group-lg">
                                            <h3>State</h3>
                                            <input type="text" placeholder="State" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="input-group input-group-lg">
                                            <h3>Zip</h3>
                                            <input type="text" placeholder="Zip" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <h3>Country</h3>
                                <input type="text" placeholder="Country" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </article>

            <article>
                <form class="form-group">
                    <div class="row section">
                        <h2 class="col-sm-12"><span class="glyphicon glyphicon-minus" style="font-size: 22px;"></span>&nbsp;How can we contact you?<br><small>The reasons we may contact you may vary depending on whether you volunteer or not, and how active you are in the church. Your privacy matter to us and we would never share your contact information with anyone outside of NPC staff.</small></h2>

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