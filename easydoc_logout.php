<?php
session_start();

if (isset($_POST["logout"])) {
	//session_destroy();
	echo "ok its work";
} else {
	header("Location: easydoc_main.php");
}


?>