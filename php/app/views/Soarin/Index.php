<?php

// Start <head> code
$head = new Soarin\HTML\Head();

// Page Title
$head -> title('Soarin PHP Framework');

// Favicon
$head -> icon('/styles/images/soarin.png');

// LESS files
$head -> less('/styles/less/master.less');

// Javascripts
$head -> js('/styles/js/master.js');

// Output <head> code
$head -> output();

?>

<body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="navbar-brand"><span class="glyphicon glyphicon-flash" style='float:left;margin-right:5px;'></span> Soarin-PHP</div>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Welcome</a></li>
            <li><a href="https://github.com/charleshross/soarin" target='_blank'>GitHub Page</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	<p class="navbar-text">Created by: <a href="https://github.com/charleshross" target='_blank'>Charles Ross</a></p>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container" style='padding-top: 70px;'>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Soarin PHP Framework</h1>
        <p>PHP as fast as possible...</p>
        <p>Thanks for using the Soarin framework!</p>
        <p>
          <a class="btn btn-lg btn-primary" href="https://github.com/charleshross/soarin#readme" target='_blank' role="button">View README &raquo;</a>
        </p>
      </div>

    </div> <!-- /container -->

</body>