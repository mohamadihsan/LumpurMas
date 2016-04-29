<?php
	/*========================= FORM LOGIN ========================*/
	function FormLogin()
	{
		?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>Login</title>
			  	<meta charset="utf-8">
			  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
			  	<!-- Tell the browser to be responsive to screen width -->
			  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  	<!-- Bootstrap 3.3.6 -->
			  	<link rel="stylesheet" href="../../bootstrap/bootstrap/css/bootstrap.min.css">
			  	<!-- Font Awesome -->
			  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
			  	<!-- Ionicons -->
			  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
			  	<!-- Theme style -->
			  	<link rel="stylesheet" href="../../bootstrap/dist/css/AdminLTE.min.css">
			  	<!-- iCheck -->
			  	<link rel="stylesheet" href="../../bootstrap/plugins/iCheck/square/blue.css">
			</head>
			<body class="hold-transition login-page">
			<div class="login-box">
			 	<div class="login-logo">
			    	<a href=""><b>Lumpur</b>Mas</a>
			  	</div>
			  	<!-- /.login-logo -->
			  	<div class="login-box-body">
			    	<p class="login-box-msg">Login</p>
			    	<form action="" method="post">
				      	<div class="form-group has-feedback">
				        	<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
				        	<span class="glyphicon glyphicon-user form-control-feedback"></span>
				      	</div>
				      	<div class="form-group has-feedback">
				        	<input type="password" name="password" class="form-control" placeholder="Password" required>
				        	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				      	</div>
				      	<div class="row">
				        	<div class="col-xs-8">
				        		<div class="checkbox icheck">

				        		</div>
				    		</div>
				    		<div class="col-xs-4">
				        		<button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Login</button>
				    		</div>
				    	</div>
					</form>
			    <div class="social-auth-links text-left">
			    	<a href="../register/" class="text-center">Daftar Akun</a>
				</div>
			</div>
			
			<!-- jQuery 2.2.0 -->
			<script src="../../bootstrap/plugins/jQuery/jQuery-2.2.0.min.js"></script>
			<!-- Bootstrap 3.3.6 -->
			<script src="../../bootstrap/bootstrap/js/bootstrap.min.js"></script>
			<!-- iCheck -->
			<script src="../../bootstrap/plugins/iCheck/icheck.min.js"></script>
		</body>
		</html>
		<?php
	}
?>