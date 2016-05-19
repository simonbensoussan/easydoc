<?php
	//classe autoloader charge automaiquement mes classes
	class Autoloader
	{

		
		/*
		revoir cette fonction :
		public static register()
		{
			spl_autoload_register(array(__CLASS__,'autoload'));
		}*/

		
		public static function autoload($name)
		{
			return require  "class/".$name.".class.php";
		}
	}