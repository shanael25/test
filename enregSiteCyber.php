<?php 
	$nom = $_GET["nom"];
	$log = $_GET["log"];
	$age = $_GET["age"];
	$pass = $_GET["mdp"];
	$infos = $_GET["infos"];
	$presentation = $_GET["pres"];
	
	// Enregistrement du client dans la BDD
	try 
	{
		
		$pdo = new PDO('mysql:host=localhost;dbname=site', 'root', 'root');
					
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if($_GET["valenreg"]) {	
		
			$ins = $pdo->prepare("insert into enregtable (nom,login,password,infos) values(?,?,?,?,?)"); 
			$ins->execute(array($nom, $age,$log, $pass, $infos));
		
			echo "Bonjour ".$nom. "vous etes inscris dans la base";
		}
		else if($_GET["verif"]){
			
			// Requete select pour verifier si l'enreg a ete realise
			$sel = $pdo->query($_GET["req"]) ;
			$col = $sel->fetch();
				
			if($col[0]>=1){
    				
				echo "<i>Vous etes bien inscris </i><br/>";				
			}
			else
			{
				echo "<i>Desole vous n'etes pas enregistre dans la base!! ! </i><br/>";
			}
		}       }
		else if($_GET["connect"]){
			$sel = $pdo->prepare("select *from enregtable whhere login= ? and password = ?"); 
			$sel->execute(array($_GET["logcnx"], $_GET["passCnx"]));
			$col = $sel->fetch();
			
			$if($col[0]>=1){
    				
				echo "<i>C'est bien vous!! </i><br/>";				
			}
			else {
				erreurLogin = false;
				erreurPassword = false;
				// Code php permettant de verifier le type d'erreur
				// ....
				// ...
				// $erreurLogin = true;
				// ...
				// $erreurPassword = true;
				if( erreurLogin == true)
					echo " Login incorrect!!";
				if( erreurPassword == true)
					echo " Password incorrect!!");
			}
		}
			
		else {
			include ( $presentation );
		}			
	}
	catch (PDOException $e)
	{
		echo "Erreur : " . $e->getMessage() . "<br/>";
		die();
	}
				
	// Fermeture BDD
	$pdo = null;
?>