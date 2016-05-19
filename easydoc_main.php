<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--Bootstrap CSS-->
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	   <link  href="easydoc_main.css" rel="stylesheet">
	<title>EasyDoc</title>
</head>
<body>

	<?php
	# style=" padding-top: 20px; padding-bottom: 70px;"
//test de toutes les méthodes de la classe Database.class.php
//tester avec des méthodes static ?!

# appel des classes
 require "class/Autoloader.class.php" ;
 autoloader::autoload("Database");
 autoloader::autoload("Form");
 autoloader::autoload("BootstrapForm");
 
 #object
 
 $formulaire = new BootstrapForm($_POST);
 $db = new Database();

 #print in console mode very usefull !!
 function die_r($value)
 {
 	echo "<pre>";
 	print_r($value);
 	echo "<pre>";
 	die();
 }

 # fonction d'affichage des resultats database
 function afficher($nom, &$donnee) # &=>passer un array en parametre
 {
 	echo "<p>". $nom ." :<strong> ".htmlspecialchars($donnee)."</strong></p><br/>";
 }
 
 #fonction calcul marge
 function prixPossible($remise,$taux,$prix_user)
		{	
			
			if($prix_user > $remise){
				$new_prix = $prix_user*($taux-1); // recupere 0.05(amazon)
				$new_prix += $remise;
				$marge = $prix_user - $new_prix;
				if($marge >= 0){
					#resulta en vert:
					$marge = "<strong style='color:#006400';>".number_format((float)$marge, 2, '.', '')."</strong>";
					echo "Voici votre marge pour ce produit: "	.$marge ."<br/>";
					echo "<p>A comparer sur le <strong>MARKETSPACE</strong></p>";
				}
				else{
					echo "Marge <strong style='color:#8B0000';>NEGATIVE</strong>";
				}
			}else{
				#resulta en rouge:
				echo "<strong style='color:#8B0000';>PRIX TROP BAS IMPOSSIBLE</strong>";
			}

		}
	
 ?>
 
<!--form = container toute la page html est contenu dans le forme-->

	<div class ="container">

		<?php include("header.php"); # APPEL DU HEADER + MENU ?>
		<div class ="row">
		 <div class ="col-lg-9">
		  <div class="panel panel-default">
	 		<div class="panel-body">
				<div class="page-header">
					  <h1>Produit Disponible <small> toute marque confondue</small></h1>
						</div>		
				<form role = "form" action ="#" method = "post">
					<div id ="produit" class ="content">
						<h3>Produit</h3>
							<?php 	
							    echo $formulaire->input("produits"); 	
								
								#affiche search bar SELECT produit_nom from produit WHERE produit_nom LIKE '% ".$_POST["produit"]."%'"
								 $query_search =" SELECT * from produit";
							    $search = $db->getAllRows($query_search);			     
								  //echo "<div class='container col-md-8'>";
								  echo	"<datalist id='produits' size ='11'>"; //style='max-height: 100px';
								  
								  foreach($search as $rows) {
									$names = $rows['produit_nom'];
								 	
								 	echo"<option value= '".$names."'>";
										   }
							   		echo" </datalist>";
							   	    echo $formulaire->submit("Validez");?>	
					</div>
					
					<!--affiche les caracteristiques public du produit-->
					<div id = "info-produit" class ="content">
						<h3>Fiche Produit</h3>
							<?php
							#$_POST[] == (isset($_POST[]) ? $_POST[] : ''); OBLIGATOIRE pour chaque $_POST
								$query_fiche ="SELECT produit_marque, produit_prix_publicHT, produit_prix_publicTTC FROM produit WHERE produit_nom =?";
								$affiche =  $db->getOneRow($query_fiche,[(isset($_POST["produits"]) ? $_POST["produits"] : '')]);
							    if($affiche)
							    {
							    	afficher("Marque Produit",$affiche["produit_marque"]);
							    	afficher("Prix public HT",$affiche["produit_prix_publicHT"]);
							    	afficher("Prix public TTC",$affiche["produit_prix_publicTTC"]);
								}
							?>
				   </div>
					
					
					<div id= "makerplace" class = "content">
						<h3>Remise Produit</h3>
							<?php
								#jointure remise par produit
								$requette = "SELECT p.produit_nom, r.remise, r.remise_prixTTC FROM remise r
											 INNER JOIN produit p 
											 ON r.produit_ID = p.ID	
											 WHERE p.produit_nom = ?";
								#print
								$affiche = $db->getOneRow($requette,[(isset($_POST["produits"]) ? $_POST["produits"] : '')]);
							    afficher("Remise en (%)",$affiche["remise"]);
							    afficher("Prix remise TTC",$affiche["remise_prixTTC"]);	?>
				
						<h3>Prix Envisagé</h3>
						
						<?php 
							#entrez input le prix user
								$form_1 = new BootstrapForm($_POST);
								echo $form_1->input('prix');
							    
								global $prix_user ;
								

							#dropdown fill from database
						 	$affiche_mp =$db->getAllRows("select * from marketspace");
							echo "<select name='marketspace'>";
							#print all element with fetchAll()
							echo "<option value='-1'>- - - Choisissez un marketspace - - -</option>";
							foreach($affiche_mp as $row) {
								$nom = $row['mp_nom'];
								
								echo "<option value = '".$nom."'>".$nom."</option>"; 
							}
							echo "</select>";  
							#button submit :   
							echo "<p><br/>".$form_1->submit("Validez")."</p>";
						   #recuperation dans combox
						   $get_mp = (isset($_POST["marketspace"]) ? $_POST["marketspace"] : '');
						  
						    
						  
							
							#récupérer le taux du market place
							#new connection
							$req = "select mp_taux from marketspace where mp_nom = ?";
							$affiche_tx = $db->getOneRow($req,[$get_mp]);
							$taux = $affiche_tx["mp_taux"];
							
							
							$remise_TTC = $affiche["remise_prixTTC"];
							$remise_taux = $remise_TTC * $taux;
							$prix_user  =(isset($_POST["prix"]) ? $_POST["prix"] : '');
							afficher("Prix remise TTC",$affiche["remise_prixTTC"]);
							afficher("Prix avec Taux marketspace",$remise_taux);

							#fonction marge:
							prixPossible($remise_TTC,$taux,$prix_user );
							
							$affiche_tx  = $db->disconnect();
							$affiche = $db->disconnect();

						?>
			</div>
	</form>

	 </div>
</div>
</div>
<div class ="col-lg-3">
				<!--LIST GROUP 1-->
				<div class="list-group">
				  <a href="https://sellercentral-europe.amazon.com/hz/inventory?tbla_myitable=sort:%7B%22sortOrder%22%3A%22ASCENDING%22%2C%22sortedColumnId%22%3A%22quantity%22%7D;search:;pagination:1;&" target="_blank" class="list-group-item active">
				    <h4 class="list-group-item-heading">AMAZON SELLER ZONE</h4>
				    <p class="list-group-item-text">Accès directement à AMAZON SELLER ZONE.</p>
				  </a>
				</div>
	</div>
</div>
</div><!--container-->
<?php include("footer.php");?>
</body>
</html> 