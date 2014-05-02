<html>
<head>
	<title>MégaSondage - Mon Profil</title>
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
			<h1>MégaSondage</h1>
		</div>
		<div id="hautGauche">
			<div class="todo">Infos utilisateur + texte bienvenue</div>
			<p>
				Bonjour <?php echo utilisateur::getPseudoUtiById($_SESSION['id']); ?>
			<form method="post" action="index.php?p=deconnexion">
				<input type="submit" value="Se déconnecter" class="boutonRouge" />
			</form>
		</div>
		<div id="hautDroit">
			<div class="todo">Sondages disponibles, les sondages auxquels l'utilisateur peut répondre</div>
			<a style="margin-left:20px;" class="boutonRouge" href="index.php?v=listeSondages">Accéder à la liste de sondages</a>
		</div>
		<div id="basGauche">
			<div class="todo">
				Mes Groupes. Bouton pour accéder à une page "groupe" affichant les groupes de l'utilisateur et les groupe publics.
				Bouton redirigeant vers une page "création groupe".
			</div>
			<a style="margin-left:20px;" class="boutonRouge" href="index.php?v=listeGroupes">Accéder à la liste de mes Groupes</a>
		</div>
		<div id="basDroit">
			<div class="todo">
				Mes sondages. Les sondages créés par l'utilisateur. Bouton pour en créer un.
			</div>
			<a style="margin-left:20px;" class="boutonRouge" href="index.php?v=mesSondages">Accéder à mes Sondages</a>
		</div>

	</div>

</body>
</html>