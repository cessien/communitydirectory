<?php
$dir = plugin_dir_url(__FILE__);
global $current_user;
global $wpdb;
$user_info = get_currentuserinfo();
?>
<!DOCTYPE html>
<html lang="en" ng-app="npccommunity">
    <head>
        <title>Hey there, <?php echo $current_user->user_login?>!</title>
        <script>window.path = "<?php echo $dir?>"</script>
        <link type="text/css" media="all" rel="stylesheet" href="<?php echo $dir;?>css/bootstrap.min.css">
        <link type="text/css" media="all" rel="stylesheet" href="<?php echo $dir;?>css/npccommunity.css">
    </head>
    <body>
        <section class="jumbotron text-center">
            <h1>Signing up: <span style="text-transform: uppercase;"><?php if($current_user->user_login !="") echo $current_user->user_login?></span><br ><small>Let's start with some basic info about yourself.</small></h1>
        </section>
        <section class="container">
            <form>
                <div class="form-group">
                    <h1>Who are you?</h1>
                    
                    <div class="row assumed-info">
                        <div class="col-md-4 col-sm-12"><div class="input-group input-group-lg">
                        <label class="label">First name</label>
                            <input class="form-control" type="text" name="first_name" placeholder="First name"></div>
                        </div>
                        <div class="col-md-4 col-sm-12"><div class="input-group input-group-lg">
                           <input class="form-control" type="text" name="first_name" placeholder="Middle name"></div>
                        </div>
                        <div class="col-md-4 col-sm-12"><div class="input-group input-group-lg">
                            <input class="form-control" type="text" name="first_name" placeholder="Last name"></div>
                        </div>  
                    </div>
                    
                    <div class="row panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span style="margin-left: 20px;">Do you want to take or upload a profile picture now?</span>
                            </h2>
                        </div>
                        <div class="panel-collapse collapse in">
                            <div class="panel-body">
                                
                            </div>
                        </div>
                    </div>
                    <div class="row panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                + How old are you?
                            </h2>
                        </div>
                        <div class="panel-collapse collapse ">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                    <div class="row panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                + Where do you live?
                            </h2>
                        </div>
                        <div class="panel-collapse collapse ">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                    <div class="row panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                + How can we contact you?
                            </h2>
                        </div>
                        <div class="panel-collapse collapse ">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                    <div class="row panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                + Do you have family at NPC?
                            </h2>
                        </div>
                        <div class="panel-collapse collapse ">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                </div>
            </form>
        </section>
        <script src="<?php echo $dir;?>js/jquery.min.js"></script>
        <script src="<?php echo $dir;?>js/bootstrap.min.js"></script>
        <script src="<?php echo $dir;?>js/angular.min.js"></script>
        <script src="<?php echo $dir;?>js/angular-route.min.js"></script>
        <script src="<?php echo $dir;?>js/angular-animate.min.js"></script>
        <script src="<?php echo $dir;?>js/npccommunity.js"></script>
    </body>
</html>