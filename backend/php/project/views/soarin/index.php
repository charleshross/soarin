<?php

$head = new HTML_Head('soarin');

$head -> title('Soarin PHP Framework');

$head -> icon('soarin.png');

$head -> less('master.less');

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
          <a class="navbar-brand" href="#">Soarin-PHP</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Welcome</a></li>
            <li><a href="http://www.github.com" target='_blank'>GitHub</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	<p class="navbar-text">Created by: Charles Ross (<a href="mailto:charleshross@gmail.com">charleshross@gmail.com</a>)</p>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Soarin PHP Framework</h1>
        <p>PHP as fast as possible...</p>
        <p>Thanks for using the Soarin framework!</p>
        <p>
          <a class="btn btn-lg btn-primary" href="http://www.github.com" target='_blank' role="button">View documentation &raquo;</a>
        </p>
      </div>

    </div> <!-- /container -->

</body>