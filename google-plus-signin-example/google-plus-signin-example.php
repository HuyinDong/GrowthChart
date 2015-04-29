<?php

	include_once('config/config.php');
     
//  start sessions
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
    	$_SESSION['clientid'] = $client_id;
	}
// CSRF Counter-measure
	$token = md5(uniqid(rand(), TRUE));
    $_SESSION['state'] = $token;
?>
    
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Sample Goolgle+ Signin</title>
		<script src="/js/jquery-1.10.2.min.js"></script>		
		<script type="text/javascript">
  			window.___gcfg = {lang: 'en'};
			(function() {
    			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    			po.src = 'https://apis.google.com/js/platform.js';
    			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			})();
		</script>
<?php
	if (!isset($_SESSION['logout'])) {
		$gScript = 'po.src = \'https://plus.google.com/js/client:plusone.js?onload=render\';';
	} else {
		$gScript = 'po.src = \'https://plus.google.com/js/client:plusone.js\';';
	}
	echo '		<script type="text/javascript">
    		(function () {
      			var po = document.createElement(\'script\');
      			po.type = \'text/javascript\';
      			po.async = true;
      			' . $gScript . '
				var s = document.getElementsByTagName(\'script\')[0];
      			s.parentNode.insertBefore(po, s);
    		})();
      	</script>
      	<script type="text/javascript">
			function render() {
		    	gapi.signin.render(\'customBtn\', {
		      		\'callback\': \'signinCallback\',
		      		\'clientid\': \'' . $_SESSION['clientid'] . '\',
		      		\'cookiepolicy\': \'single_host_origin\',
		      		\'requestvisibleactions\': \'http://schemas.google.com/AddActivity\',
		      		\'scope\': \'https://www.googleapis.com/auth/plus.login email\'
		    	});
		  	}
      	</script>
      	<script type="text/javascript">
			function signinCallback(authResult) {
				if (authResult[\'code\']) {
						$.post( "/ajx/plus.php?storeToken", { code: authResult[\'code\'], state: "' . $_SESSION['state'] . '"},
							function( data ) {
								$(\'#gPlus\').empty().append( data );
				      		}
						);
		  		}
			};
		</script>
		<script type="text/javascript">
			function revokeAccess() {
				$.post("/ajx/plus.php?revoke", {state: "' . $_SESSION['state'] . '"},
					function( data ) {
						$(\'#gPlus\').empty().append( data );
					}
				);
	  		};
		</script>
		<script type="text/javascript">
			function gvnSignOut() {
				$.post( "/ajx/plus.php?logout", {state: "' . $_SESSION['state'] . '"},
				function( data ) {
					$(\'#gPlus\').empty().append( data );
				});
				gapi.auth.signOut();
			};
		</script>
		<style type="text/css">
			#customBtn {cursor: pointer;}
			#customBtn:hover {text-decoration: underline; cursor: hand;}
		</style>
';
	$gPlusWhenLogout = '		<div id="gSignInWrapper">
				<div id="customBtn">
					<a onclick="gapi.auth.signIn({\'clientid\' : \'' . $_SESSION['clientid'] . '\',\'cookiepolicy\' : \'single_host_origin\',
\'callback\' : \'signinCallback\',\'requestvisibleactions\' : \'http://schemas.google.com/AddActivity\',\'scope\' : \'https://www.googleapis.com/auth/plus.login email\'}); $(\'#customBtn\').hide();">+Sign In</a>
				</div>
			</div>';
	
	if (isset($_SESSION['access_token'])) {
		if (isset($_SESSION['logout'])) {
			$gPlus = $gPlusWhenLogout;
		} else {
			if (isset($_SESSION['givenName']))
				$gPlus = '		<div id="gPlusNav">
				<a href="https://plus.google.com/u/0/">+' . $_SESSION['givenName']  . '</a>&nbsp;&nbsp;&nbsp;
				<a href="' . $_SESSION['profileURL'] . '" class="dropdown-toggle" data-toggle="dropdown"><img src="../img/gphotocache.png" style="background:url(\'' . $_SESSION['photo'] . '\');"></a>&nbsp;&nbsp;&nbsp;
				<a onclick="gvnSignOut(); return false;" href="#">Disconnect me</a>&nbsp;&nbsp;&nbsp;
				<a onclick="revokeAccess(); return false;" href="#">Remove my consent</a>
			</div>';
		}
	} else {
		if (isset($_SESSION['logout'])) {
			$gPlus = $gPlusWhenLogout;
		} else {
			$gPlus = '		<div id="gSignInWrapper">
				<div id="customBtn" class="customGPlusSignIn">
					<a>+Sign In</a>
				</div>
			</div>';
		}
	}
?>
	</head>
	<body>
		<h1>Simple Google+ Signin using the one-time code server flow</h1>
		<p>This sample shows Google+ signin in action using a custom signin button. You can also try disconnect and remove your consent.</p>
		<br />
<?php 
echo "		<div id = \"gPlus\" style=\"border: 1px solid; padding: 10px\">
	$gPlus
		</div>
";		
?>
	</body>	
</html>
