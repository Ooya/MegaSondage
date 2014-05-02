<html>
<head>
	<title>MégaSondage - Mes Sondages</title>
	<meta charset="utf-8">
	<meta name="author" content="Samuel Bricas, Thibaut Castanié" />
	<link rel="stylesheet" type="text/css" href="./css/style.css">

	<script type="text/javascript" src="http://jindo.dev.naver.com/collie/deploy/collie.min.js"></script>
	<script type="text/javascript" src="./js/ironManCollie.js"></script>
</head>
<body onload="ironManTourne();">

	<div id="contenu">

		<div id="titre">
			<div id="ironMan" style="display:inline-block;float:left;"></div>
			<h1><a href="index.php">MégaSondage</a></h1>
		</div>
		<div id="pleinePage">

			<div class="affichageBloc">
				<form id="creationSondage" method="post" action="">
					<h3>Créer un sondage</h3>
					<input type="text" name="nomSondage" placeholder="Nom du sondage" />
					<input type="submit" name="creerSondage" value="Créer le sondage" class="boutonRouge" />
				</form>

				<p>Type de sondage
					<select form="creationSondage">
						<option value="sondagePublic">1 - Sondage Public (accessible par tous)</option>
						<option value="sondageReserve">2 - Sondage Réservé (accessible aux membres du site)</option>
						<option value="sondageGroupe">3 - Sondage de groupe (accessible seulement au membres du groupe)</option>
						<option value="sondagePrive">4 - Sondage Privé (accessible seulement aux membres invités)</option>
					</select>
				</p>
				<p>Groupe (laisser vide si le choix précédent est différent de l'option 3)
					<select form="choixGroupeSondage">
						<!-- Liste des groupes auquel le membre appartient -->
						<option value="groupe1">Groupe 1</option>
						<option value="groupe2">Groupe 2</option>
					</select>
				</p>
			</div>

			<hr>

			<?php
			$listeS = sondage::getSondUtiById($_SESSION['id']);
			for ($i=0; $i < sizeof($listeS); $i++) { ?>
			<div class="affichageBloc">
				<h3><?php echo sondage::getNameById($listeS[$i]) ?></h3>
				<?php 
					$listeO = sondage::getListOptionById($listeS[$i]);
					for ($j=0; $j < sondage::getNbOptionBySondId($listeS[$i]); $j++) {
				?>
				<p><?php echo $listeO[$j]; ?> : <?php echo sondage::getSommeScore($listeS[$i],$listeO[$j]) ?></p>
				<?php
				}
				?>
			</div>

			<?php
		}
		?>

	</div>
</div>

</body>
</html>