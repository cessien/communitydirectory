<?php
if(!session_id()) {
    session_start();
}

$dir = "/wordpress/wp-content/plugins/npcdirectory/";
global $current_user;
$user_info = get_currentuserinfo();

$_SESSION["current_step"] = "person"; //The current step of the wizard. 1 - person, 2 - family, 3 - community
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
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">NPC Community Directory</a>
            </div>
            <ul class="nav navbar-nav">
            <li class="active"><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </nav>
        <section class="jumbotron text-center">
            <h1>Signing up: <span style="text-transform: uppercase;"><?php if($current_user->user_login !="") echo $current_user->user_login?></span><br ><small>Let's start with some basic info about yourself.</small></h1>
        </section>
        <section class="container">
            <div id="main-view" ng-controller="view-controller" ></div>
            <div class="row navigation">
                <div class="col-sm-6">
                    <h1 class="previous"><a ng-href="#" ng-click="paginate('prev')">&lt; Previous</a></h1>
                </div>
                <div class="col-sm-6">
                    <h1 class="next" ><a ng-href="#" ng-click="submitAll('next')">Continue &gt;</a></h1>
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