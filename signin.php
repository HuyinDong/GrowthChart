
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">
    <link rel="openid.server" href="http://www.example.com/simpleid/" />
	<link rel="openid2.provider" href="http://www.example.com/simpleid/" />
    <title>Online Growth Charts</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet"> 
    <link href="css/ace.css" rel="stylesheet" >
	<style>
	body{
	background:#ccc;
	margin-top:50px;
	}
	#sign{
	margin: 0 auto;
	margin-top:80px;
	width: 400px;
	border : 1px solid #ccc;

	}
	#title{

	}
	</style>
     <script type="text/javascript" src="js/ogc.js"></script>
    <!-- script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/angular-resource.min.js"></script>    
	<script src="http://code.highcharts.com/modules/exporting.js"></script>

    <script type="text/javascript" src="js/public/hello.js"></script -->
	<script src="https://apis.google.com/js/client:platform.js" async defer></script>	
	<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script src="bootstrap-3.1.1/dist/js/bootstrap.min.js"></script>



    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
   <!-- <link href="css/signin.css" rel="stylesheet">-->
 </head>	

 
<!-- NAVBAR
================================================== -->
<body>
    
	<div class="navbar-wrapper">
	<div class="container">
		<div class="navbar-container" id="navbar-container">
		<!--div class="  navbar-container navbar-inverse navbar-fixed-top" role="navigation" --> 

			<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
				<span class="sr-only">Toggle sidebar</span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>
			</button>

			 

			<div class="navbar-buttons navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">
					<li class="green">
						<a  href="#">
							<i class="fa fa-child fa-2x  "></i> 
							<span class="user-info">
								<big>Infants and Babies </big>
								<small> 0 ~ 36 months</small>
							</span>
						</a>
					</li>

					<li class="blue">
						<a href="#">
							<i class="fa fa-male fa-2x  "></i> 
							<span class="user-info">
								<big>Children  and Teens  </big>
								<small> 2 ~ 20 years</small>
							</span>
						</a>
					</li>

					<li class="purple">
						<a href="#">
							<i class="ace-icon fa fa-envelope"></i>
							<big> Contact  </big>
						</a>

					</li>

					<li class="light-blue">
						<a href="#">
							<i class="ace-icon fa fa-user"></i>
							<big> Sign Up  </big>
						</a>

					</li>

					<li class="red">
						<a  href="#">
							<i class="ace-icon fa fa-lock"></i></a>
					</li>
				</ul>
			</div>
		</div><!-- /.navbar-container -->
	</div>
</div> 

<div id = 'sign'>

<form class="form-horizontal">
<h3 class = 'align-center'>Sign in</h3>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
    </div>
  </div>
  
  <div class="form-group">
	<span id="signinButton">
 <div id="gConnect">
    <button class="g-signin"
        data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email"   
        data-requestvisibleactions="http://schemas.google.com/AddActivity"
        data-clientId="526876616106-0vs3d4u7hk68guk0lcdou385j1f8p24b.apps.googleusercontent.com"
        data-callback="onSignInCallback"
        data-theme="dark"
        data-cookiepolicy="single_host_origin">
    </button>
  </div>
</span>
    
    </div>
 <button id="disconnect" class="btn btn-primary btn-lg btn-block">Disconnect</button>
<div class="col-sm-offset-2 col-sm-4" id = 'profile'>
  </div>
</form>
</div>
<script>
var helper = (function() {
  var BASE_API_PATH = 'plus/v1/';

  return {
    /**
     * Hides the sign in button and starts the post-authorization operations.
     *
     * @param {Object} authResult An Object which contains the access token and
     *   other authentication information.
     */
    onSignInCallback: function(authResult) {
      gapi.client.load('plus','v1').then(function() {
        if (authResult['access_token']) {
          $('#authOps').show('slow');
          $('#gConnect').hide();
          helper.profile();
          helper.people();
        } else if (authResult['error']) {
          // There was an error, which means the user is not signed in.
          // As an example, you can handle by writing to the console:
          console.log('There was an error: ' + authResult['error']);
          $('#authResult').append('Logged out');
          $('#authOps').hide('slow');
          $('#gConnect').show();
        }
        console.log('authResult', authResult);
      });
    },

    /**
     * Calls the OAuth2 endpoint to disconnect the app for the user.
     */
    disconnect: function() {
      // Revoke the access token.
      $.ajax({
        type: 'GET',
        url: 'https://accounts.google.com/o/oauth2/revoke?token=' +
            gapi.auth.getToken().access_token,
        async: false,
        contentType: 'application/json',
        dataType: 'jsonp',
        success: function(result) {
          alert(result);
          $('#authOps').hide();
          $('#profile').empty();
          $('#visiblePeople').empty();
          $('#authResult').empty();
          $('#gConnect').show();
        },
        error: function(e) {
          console.log(e);
        }
      });
    },

    /**
     * Gets and renders the currently signed in user's profile data.
     */
    profile: function(){
      gapi.client.plus.people.get({
        'userId': 'me'
      }).then(function(res) {
        var profile = res.result;
        $('#profile').empty();
        $('#profile').append(
            $('<p><img src=\"' + profile.image.url + '\"></p>'));
        $('#profile').append(
            $('<p>Hello ' + profile.displayName + '!</br>' + '</p>'));
        if (profile.cover && profile.coverPhoto) {
          $('#profile').append(
              $('<p><img src=\"' + profile.cover.coverPhoto.url + '\"></p>'));
        }
      }, function(err) {
        var error = err.result;
        $('#profile').empty();
        $('#profile').append(error.message);
      });
    }
  };
})();

/**
 * jQuery initialization
 */
$(document).ready(function() {
  $('#disconnect').click(helper.disconnect);
  $('#loaderror').hide();
  if ($('[data-clientid="YOUR_CLIENT_ID"]').length > 0) {
    alert('This sample requires your OAuth credentials (client ID) ' +
        'from the Google APIs console:\n' +
        '    https://code.google.com/apis/console/#:access\n\n' +
        'Find and replace YOUR_CLIENT_ID with your client ID.'
    );
  }
});

/**
 * Calls the helper method that handles the authentication flow.
 *
 * @param {Object} authResult An Object which contains the access token and
 *   other authentication information.
 */
function onSignInCallback(authResult) {
  helper.onSignInCallback(authResult);
}
</script>
</body>
</html>


