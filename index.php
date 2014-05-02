<?php

session_start();

include "modele/utilisateur.php";
include "modele/sondage.php";
include "modele/groupe.php";

if(isset($_GET['p']) && file_exists('controleurs/'.$_GET['p'].'.php')){
	include 'controleurs/'.$_GET['p'].'.php';
}

if(isset($_GET['v']) && file_exists('vues/'.$_GET['v'].'.php')){
	include 'vues/'.$_GET['v'].'.php';
}

if (((!(isset($_SESSION['id'])) )) &&
	($_SERVER['REQUEST_URI'] != "/~tcastanie/ProjetWeb/index.php?v=listeSondagesPublics") &&
	($_SERVER['REQUEST_URI'] != "/~tcastanie/ProjetWeb/index.php?p=voteSondage") ){
	include './vues/accueil.php';
}
else if (isset($_SESSION['id']) &&
	($_SERVER['REQUEST_URI'] != "/~tcastanie/ProjetWeb/index.php?v=listeSondages") &&
	($_SERVER['REQUEST_URI'] != "/~tcastanie/ProjetWeb/index.php?v=listeGroupes") &&
	($_SERVER['REQUEST_URI'] != "/~tcastanie/ProjetWeb/index.php?v=mesSondages")){
	include './vues/profil.php';
}


?>

<!-- 
finir sondage non connecté
Faire affichage sondage quand connecté + enregistrement
Affichage des groupes auxquel l'utilisateur appartient
Création sondage/groupe
Affichage de MES sondages + stats (résultats)

bouton retour accueil

Commentaires
Nommer un modérateur
 -->