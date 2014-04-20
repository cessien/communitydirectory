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
        <script src="<?php echo $dir;?>js/angular.min.js"></script>
        <script src="<?php echo $dir;?>js/angular-route.min.js"></script>
        <script src="<?php echo $dir;?>js/angular-animate.min.js"></script>
        <style>
            .full {
                /* margin-top: 15%; */
            }
            
            @-webkit-keyframes fadeIn {
                from 	{ opacity: 0.0;}
                to 	{ opacity: 1.0;}
            }
            
            @-webkit-keyframes fadeOut {
                from 	{ opacity: 1.0;}
                to 	{ opacity: 0.0;}
            }
            
            .valid {
                border-color: #070;
                color: #070;
                background-color: #dfffdf;
            }
            
            .toggle {
                -webkit-transition: all 0 cubic-bezier(0.25, 0.46, 0.45, 0.94);
                -moz-transition: all 0 cubic-bezier(0.25, 0.46, 0.45, 0.94);
                -ms-transition: all 0 cubic-bezier(0.25, 0.46, 0.45, 0.94);
                -o-transition: all 0 cubic-bezier(0.25, 0.46, 0.45, 0.94);
                transition: all 0 cubic-bezier(0.25, 0.46, 0.45, 0.94);
                /* easeOutQuad */
                -webkit-transition-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
                -moz-transition-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
                -ms-transition-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
                -o-transition-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
                transition-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
                /* easeOutQuad */
            }

            .toggle.ng-enter {
                opacity: 0;
                transition-duration: 250ms;
                -webkit-transition-duration: 250ms;
            }

            .toggle.ng-enter-active {
                opacity: 1;
            }

            .toggle.ng-leave {
                opacity: 1;
                transition-duration: 250ms;
                -webkit-transition-duration: 250ms;
            }

            .toggle.ng-leave-active {
                opacity: 0;
            }

            .toggle.ng-hide-add {
                transition-duration: 250ms;
                -webkit-transition-duration: 250ms;
                opacity: 1;
            }

            .toggle.ng-hide-add.ng-hide-add-active {
                opacity: 0;
            }

            .toggle.ng-hide-remove {
                transition-duration: 250ms;
                -webkit-transition-duration: 250ms;
                display: block !important;
                opacity: 0;
            }

            .toggle.ng-hide-remove.ng-hide-remove-active {
                opacity: 1;
            }
        </style>
    </head>
    <body>
        <section class="jumbotron text-center">
            <h1>Hey there, stranger<?php if($current_user->user_login !="") echo " (".$current_user->user_login.")"?>!<br ><small>Let's get started with some basic info...</small></h1>
        </section>
        <div ng-view id="mainview" class="toggle"></div>
        <div><?php echo $wpdb->get_row()?></div>
        <script src="<?php echo $dir;?>js/jquery.min.js"></script>
        <script src="<?php echo $dir;?>js/bootstrap.min.js"></script>
        <script src="<?php echo $dir;?>js/npccommunity.js"></script>
    </body>
</html>