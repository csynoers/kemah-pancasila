
<!DOCTYPE html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Page</title>

        <!-- Icon -->
        <link rel="shortcut icon" href="../images/icon.png">

        <!-- Vendor CSS -->
        <link href="assets/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="assets/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
            
         <!-- CSS -->
        <link href="assets/css/mdl.app.css" rel="stylesheet">
        <link href="assets/css/mdl.app.min.css" rel="stylesheet">

        <script language="javascript">
		function validasi(form){
		  	if (form.username.value == ""){
		    		alert("Anda belum mengisikan Username.");
		    		form.username.focus();
		    		return (false);
		  	}
		     
		  	if (form.password.value == ""){
		    		alert("Anda belum mengisikan Password.");
		    		form.password.focus();
		    		return (false);
		  	}
		  	return (true);
		}
		</script>

    </head>
    
    <body class="login-content">
        <!-- Login -->
        <div class="lc-block toggled" id="l-login">
        	<div><img src="../images/logo.png" style="width:250px;padding-bottom:15px;" title="Melatimas"></div>
            <form name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)">
            
	            <div class="input-group m-b-20">
	                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
	                <div class="fg-line">
	                    <input type="text" class="form-control" placeholder="Username" name="username"  onClick="jQuery(this).val(&quot;&quot;);">
	                </div>
	            </div>
	            
	            <div class="input-group m-b-20">
	                <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
	                <div class="fg-line">
	                    <input type="password" class="form-control" placeholder="Password" name="password" onClick="jQuery(this).val(&quot;&quot;);">
	                </div>
	            </div>
	       
	            <button type="submit" class="btn btn-login btn-danger btn-float"><i class="zmdi zmdi-arrow-forward"></i></button>
            </form>
        </div>
        
        <!-- Javascript Libraries -->
        <script src="assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/vendors/bower_components/Waves/dist/waves.min.js"></script>

        <script src="assets/js/functions.js"></script>
        
    </body>

</html>
