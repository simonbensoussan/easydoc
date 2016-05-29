<?php
# HEADER :
	session_start();
	$admin = (isset( $_SESSION["admin"]) ? $_SESSION["admin"] : '');
  
	//class="bg-warning"
	if (isset($_POST["btn_logout"]) && isset($_SESSION["admin"])) {
		session_start();
    session_unset($_SESSION["admin"]);
		session_destroy();
		//$_SESSION["admin"] = "";
		header("Location: easydoc_admin.php");
    exit;
	}
	?>
 <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right"> 
          <!--  <li role="presentation" ><a href="#"></a></li>-->
            <li role="presentation"><a href="#">About</a></li>
            <li role="presentation"><a href="#">Contact</a></li>
            <li role="presentation" class="active"><a href="easydoc_admin.php">Log out</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">EASYDOC</h3>
      </div>
