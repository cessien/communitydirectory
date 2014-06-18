<!DOCTYPE html>
<html lang="en" ng-app="npccommunity">
    <head>
        <title>Community Directory</title>
        <script>window.path = "<?php echo $dir?>"</script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" media="all" rel="stylesheet" href="<?php echo $dir;?>css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.2/css/jasny-bootstrap.min.css">-->
        <link type="text/css" media="all" rel="stylesheet" href="<?php echo $dir;?>css/npccommunity.css">
    </head>
    <body ng-controller="main-controller">
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
              <a class="navbar-brand" href="#"><span>NPC |</span> Community Directory</a>
            </div>
            <ul class="nav navbar-nav">
            <li class="active"><a href="/wordpress/people">People</a></li>
            <li><a href="/wordpress/family">Families</a></li>
            <li><a href="/wordpress/community">Communities</a></li>
            <li class="dropdown">
              <a href="/wordpress/registration" class="dropdown-toggle" data-toggle="dropdown">Create<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">New Person</a></li>
                <li><a href="#">New Family</a></li>
                <li><a href="#">New Community</a></li>
                <li class="divider"></li>
                <li><a href="/wordpress/registration">Wizard</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Edit<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">A Person</a></li>
                <li><a href="#">A Family</a></li>
                <li><a href="#">A Community</a></li>
              </ul>
            </li>
          </ul>
        </nav>
        
        <section class="container-fluid">