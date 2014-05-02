<html>
<head>
	<title>MégaSondage - Groupes</title>
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
				<form id="creationGroupe" method="post" action="">
					<h3>Créer votre groupe</h3>
					<input type="text" name="nomGroupe" placeholder="Nom du groupe" />
					<input type="submit" name="creerGroupe" value="Créer le groupe" class="boutonRouge" />
				</form>

				<p>Type de groupe
					<select form="creationGroupe">
						<option value="groupePublic">Groupe Public (visible et accessible par tous)</option>
						<option value="groupePriveVisible">Groupe Privé Visible (visible par tous, accessible sur invitation)</option>
						<option value="groupePriveCache">Groupe Privé Caché (invisible, accessible sur invitation)</option>
					</select>
				</p>
			</div>

			<hr>

			<?php
			$var = utilisateur::getlistGroupUtiById($_SESSION['id']);
			for ($i=0; $i < sizeof($var); $i++) { 
				?>

				<div class="affichageBloc">
					<h3><?php echo $var[$i]; ?></h3>
					<form id="nommerAdmin" method="post" action="">
						<input type="text" name="nomModo" placeholder="Nom du modérateur" /> <p>(uniquement si vous êtes administrateur)</p>
						<input type="submit" name="ajouterModo" value="Nommer le modérateur" class="boutonRouge" />
					</form>
				</div>
				<?php	
			}
			?>

			<hr>

			<?php
			$var2 = groupe::getListGroupe();
			for ($j=0; $j < sizeof($var2); $j++) { 
				?>
				<form method="post" action="index.php?p=postulage">
					<div class="affichageBloc">
						<input type="hidden" name="nomGroupe" value="<?php echo $var2[$j]; ?>" />
						<h3><?php echo $var2[$j]; ?></h3>
						<p><?php echo groupe::getAdminGroupeByName($var2[$j]); ?></p>
						<input type="submit" name="postulage" value="Postuler" class="boutonRouge" />
					</div>
				</form>

				<?php	
			}
			?>
		</div>
		
	</div>

</body>
</html>