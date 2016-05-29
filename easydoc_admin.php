
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--Bootstrap CSS-->
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	   <link  href="easydoc_main.css" rel="stylesheet">
	<title>EasyDoc</title>
</head>
<body>

<div class ="container">

		<?php include("header.php"); # APPEL DU HEADER + MENU ?>
		
		<div class ="row">
		 <div class ="col-lg-9">
		  <div class="panel panel-default">
	 		<div class="panel-body">
				<div class="page-header">
					  <h1>Connexion <small> administrateur</small></h1>
					</div>
						  <form class="form-horizontal" method ="post" action ="easydoc_login.php">
						  <div class="form-group">
						    <label class="col-sm-2 control-label">Username</label>
						    <div class="col-sm-10">
						      <input type='text' class='form-control'  name='username' placeholder='Username'>
						    </div>
						  </div>
						  <div class="form-group">
						    <label  class="col-sm-2 control-label">Password</label>
						    <div class="col-sm-10">
						      <input type="password" class="form-control"  name="password" placeholder="Password">
						    </div>
						  </div>	
						  <div class="form-group">
						    <div class="col-sm-offset-2 col-sm-10">
						      <button type="submit" name ="btn_login" class="btn btn-primary">Log in</button>
						    </div>
						  </div>
						</form>	
				</div>
			</div>
		</div>
	</div>
</div>
 	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	 
	  <?php include("footer.php");?>

</body>	
</html>
