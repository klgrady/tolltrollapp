<?php

function start_page() {
  ?>
  <!doctype HTML>
  <html>
        <head>
                <title>TollTroll</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            .jumbotron {
                background-color: #000000;
                color: #ffffff;
                margin-top: 0px !important;
            }
            .navbar-default {
                margin-bottom: 0;
           }
           .login-bar {
                text-align: center;
           }
	   #map {
		height: 100%;
	   }
        </style>
        </head>
        <body>

        <nav class="navbar">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">TollTroll</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="userpref.php">Set Preferences</a></li>
          <li><a href="starttrip.php">Start a Trip</a></li>
          <li><a href="#">Do Something Cool</a></li>
        </ul>
	<ul class="nav navbar-nav navbar-right">
	  <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	</ul>
      </div>
    </nav>

    <div class="jumbotron text-center">
        <h1>TollTroll</h1>
        <p>Because it rhymes</p>
    </div>
<?php
}

function end_page() {
    ?>
        </body>
        </html>
    <?php
}

function login_prompt() {
    //remove last session if it's still hanging around
	stop_session();
    ?>
	<div class="container">
	<form action="index.php" method="post" class="form-horizontal">
	  <div class="form-group">
		<label class="control-label col-sm-2" for="user">Username:</label>
		<div class="col-sm-10">
		  <input type="text" id="user" name="user">
		</div>
	  </div>
	  <div class="form-group">
		<label class="control-label col-sm-2" for="passwd" name="passwd">Password:</label>
		<div class="col-sm-10">
		  <input type=password id="passwd" name="passwd">
		</div>
	  </div>
    	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	  	<button type="submit" class="btn tn-default">Submit</button>
	    </div>
	  </div>
	</form>
	</div>
    <?php
}

function page_content() {
	?>
	  <div class="container">
	    <div class="row">
		<div class="col-md-6"><div class="panel panel-default"><div class="panel-body">Content here</div></div></div>
		<div class="col-md-6">Maybe image here</div>
	    </div>
	  </div>

	<?php
}

function stop_session() {
  //from Murach's PHP & MySQL
  //end a session
  $_SESSION = array();
  session_destroy();

  //delete session cookie
  $name = session_name();
  $expire = strtotime('-1 year');
  $params = session_get_cookie_params();
  $path = $params['path'];
  $domain = $params['domain'];
  $secure = $params['secure'];
  $httponly = $params['httponly'];
  setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
}
