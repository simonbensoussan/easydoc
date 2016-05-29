<?php
//session_start();
if (isset($_POST["btn_login"])) 
{
	require "class/Autoloader.class.php" ;
 	autoloader::autoload("Database");
	
	$link = new Database();
	$query = "SELECT * from login WHERE Username = '".$_POST["username"]." ' AND Password = '".$_POST["password"]."'";
	$row = $link ->getOneRow($query);
	
	if ($row > 0) {
		session_start();
		$_SESSION["admin"] = "Alaal";
		header("Location: easydoc_main.php");
		exit;
	} 
	else 
	{
		echo "<h4>Connexion invalide ...</h4>";
		exit;
	}

}

?>
