<?php


if(!empty($_POST['email']) && !empty($_POST['mdp']) )
{
	if(utilisateur::bonIdent($_POST['email'], $_POST['mdp'])){
		$_SESSION['id'] = utilisateur::getIdUtiByMail($_POST['email']);
		$id=$_SESSION['id'];
		header('./vues/profil.php');
	}
	else
	{	
		$messageConnexion = "Erreur de connexion";
	}
}
else
{
	header('location:index.php');
}

?>