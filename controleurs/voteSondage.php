<?php

include './modele/vote.php';

if(($_POST['Choix1'] != $_POST['Choix2']) && ($_POST['Choix2'] != $_POST['Choix3'])){
	
	$i = vote::getNbOpt($_POST['idDuSondage']);
	$j=1;

	for ($i; $i > 0; $i--) {
		vote::addVote($i,$_POST['idDuSondage'],$_POST['Choix'.$j]);
		$j ++;
	}

	echo "Vote enregistré !!!";
	header('./vues/listeSondagesPublics.php');

}
else{
	echo "La même option ne peut pas être votée plusieurs fois.";
	header('./vues/listeSondagesPublics.php');
}



?>