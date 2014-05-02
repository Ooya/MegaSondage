<?php

if (!empty($_POST['email']) && !empty($_POST['mdp'])  && !empty($_POST['pseudo'])){
	$inscrit = utilisateur::addUtilisateur($_POST['pseudo'],$_POST['mdp'],$_POST['email']);
	if ($inscrit == 1) {
		$messageInscription = "Vous êtes inscrit ! Vous pouvez vous connecter, avec votre mail : ".$_POST['email'];
	}
	else{
		$messageInscription = "Erreur inscription, veuillez rééssayer avec des informations différentes";
	}
}
else
{

	header('Location:index.php');
}





?>