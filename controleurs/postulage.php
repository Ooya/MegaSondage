<?php

groupe::addMembre($_POST['nomGroupe'],$_SESSION['id']);

echo "Vous faites partie du groupe !";
header('./vues/listeGroupes.php');


?>