<html>
<head>
	<title>MégaSondage - Sondages</title>
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
			<?php

			for ($i=0; $i < sondage::getNbSondPub(); $i++) { 
				$idSondage = sondage::getIdSondByType(1);
				?>
				<div class="affichageBloc">
					<form id="reponseSondage" method="post" action="index.php?p=voteSondagePublic">
						<input type="hidden" name="idDuSondage" value="<?php echo $idSondage[$i]; ?>" />
						<h3><?php echo sondage::getTitreById($idSondage[$i]); ?></h3>
						<p><?php echo sondage::getDescById($idSondage[$i]); ?></p>
						<p>Date de fin : <?php echo sondage::getDateById($idSondage[$i]); ?></p>
						<ul>
							<?php 
							for ($j=0; $j < sondage::getNbOptionBySondId($idSondage[$i]); $j++) {
								?>
								<li>
									Choix <?php echo ' '.$j+1; $listeOptions = sondage::getListOptionById($idSondage[$i]);?>
									<select name="<?php echo 'Choix'; echo $j+1; ?>" >
										<?php 
										for ($k=0; $k < sondage::getNbOptionBySondId($idSondage[$i]); $k++) {
											?>
											<option value="<?php echo sondage::getIdOptionByIntitule($listeOptions[$k]) ?>"><?php echo $listeOptions[$k]; ?></option>
											<?php
										}
										?>
									</select>
								</li>
								<?php
							}
							?>
						</ul>
						<input type="submit" value="Voter" class="boutonRouge" />
					</form>
				</div>
				<?php 
			} 

			if (isset($messageAVote)){
				echo $messageAVote;
			}
			?>

		</div>

	</div>

</body>
</html>