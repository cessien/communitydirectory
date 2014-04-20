<?php
require_once( dirname(__FILE__) . '/wp-load.php' );
global $current_user;
$user_info = get_currentuserinfo();

?>
<!DOCTYPE html>
<html lang="en" ng-app="npccommunity">
    <head>
        <title>God loves <?php echo $current_user->user_login?></title>
        <link type="text/css" media="all" rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/angular.min.js"></script>
        <script src="js/angular-route.min.js"></script>
        <script src="js/angular-animate.min.js"></script>
        <script src="js/angular-sanitize.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/npccommunity.js"></script>
        <style>
            @import url(http://fonts.googleapis.com/css?family=Open+Sans:400,300,700);
            @import url(http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300);
            
            h1,h1,h3,h4,p,span {
                font-family: 'Open Sans', sans-serif;
            }
            
            .logo > span {
            }
            
            .logo > .primary {
            }
            
            .npc-search-result {
                list-style: none;
                padding: 20px;
            }
            
            .npc-search-result > li {
                border-bottom: 2px solid #ccc;
            }
            .npc-search-result > li:hover {
                background-color: #eef;
                cursor: pointer;
            }
        </style>
    </head>
    <body ng-controller="search" class="container">
        <section class="jumbotron text-center">
            <h1 class="logo"><span class="primary">NPC</span>&nbsp;<span>Directory</span></h1>
        </section>
        <div class="row">
            <div id="custom-search-input">
                <div class="input-group input-group-lg col-md-12">
                    <input type="text" ng-model="keywords" class="search-query form-control" placeholder="Search" ng-change="search()"/>
                    <span class="input-group-btn">
                        <button class="btn " type="button">
                            <span class=" glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <pre ng-bind-html="result"></pre>
        </div>
    </body>
</html>