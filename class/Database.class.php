<?php

 /**
 * class Database concentre toutes les méthodes 
 * pour faire tourner un db 
 * INDEX bas de la page.
 */
 class Database 
 	{
 		/**
 		* Zend Studio => Dvlpt in PHP !!
 		* classe a utiliser avec JAVA !!
 		* isConnect =>check if db connected
 		* datab => get result of data from db
 		*/
 		public $isConnect;
 		protected $datab;
 		//connect to db
 	 public function  __construct($dbname="easydoc",$username='root',$password= '',$host="localhost",$option=[])
 	 {
 	 	$this->isConnect = TRUE;
 	 	try {
 	 		$this->datab = new PDO("mysql:host=".$host.";dbname=".$dbname.";charset=utf8",$username , $password,$option);
 	 		$this->datab->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 	 		$this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
 	 	} catch (Exception $e) { #PDOException
 	 		# other way : Throw new Exception($e->getMessage());
 	 		echo $e->getMessage();
 	 	}
 	 }
 		//disconnect to db
 	 public function disconnect()
 	 {
 	 	$this->isConnect = FALSE;
 	 	$this->datab = NULL;
 	 }
 	 	//get one row
 	 public function getOneRow($query,$params = [])
 	 {
 	 	try {
 	 		$stmt = $this->datab->prepare($query);
 	 		$stmt->execute($params);
 	 		return $stmt->fetch();
 	 	} catch (Exception $e) {
 	 		echo $e->getMessage();
 	 	}
 	 }
 	 	//get all rows
 	 public function getAllRows($query,$params = [])
 	 {
 	 	try {
 	 		$stmt = $this->datab->prepare($query);
 	 		$stmt->execute($params);
 	 		return $stmt->fetchAll();
 	 		/*
 	 		AFFICHER LES ELEMENTS :
 	 		foreach($nom_varaible as $row) {
						$id = $row['id'];
						$name = $row['name'];
						etc ...
						}*/
 	 	} catch (Exception $e) {
 	 		echo $e->getMessage();
 	 	}
 	 }
 	 
 	    // insert to db
 	 public function insert($query,$params = [])
 	 {
 	 	try {
 	 		$stmt = $this->datab->prepare($query);
 	 		$stmt->execute($params);
 	 		return TRUE;
 	 	} catch (Exception $e) {
 	 		echo $e->getMessage();
 	 	}
 	 }
 	 	//update db
 	 public function update($query,$params = [])
 	 {
 	 	$this->insert($query,$params);
 	 }
 	 	//delete to db
 	 public function delete($query,$params = [])
 	 {
 	 	$this->insert($query,$params);
 	 }

 	 /**
 	 * INDEX :
 	 *<?php
		*	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		*	?> AUTRE METHODE !!
 	 */







 	}

