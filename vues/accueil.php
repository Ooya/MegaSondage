<html>
<head>
	<title>MégaSondage - Accueil</title>
	<meta charset="utf-8">
	<meta name="author" content="Samuel Bricas, Thibaut Castanié" />
	<link rel="stylesheet" type="text/css" href="./css/style.css">

	<script type="text/javascript" src="http://jindo.dev.naver.com/collie/deploy/collie.min.js"></script>
	<script type="text/javascript" src="./js/ironManCollie.js"></script>

	<script>
	function surligne(champ, erreur)
	{
		if(erreur)
			champ.style.backgroundColor = "#fba";
		else
			champ.style.backgroundColor = "";
	}


	function verifMail(champ)
	{
		var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
		if(!regex.test(champ.value))
		{
			surligne(champ, true);
			return false;
		}
		else
		{
			surligne(champ, false);
			return true;
		}
	} 
	</script>
</head>

<body onload="ironManTourne();">
	<div id="contenu">	
		<div id="titre">
			<div id="ironMan" style="display:inline-block;float:left;"></div>
			<h1>MégaSondage</h1>
		</div>
		<div id="hautGauche">
			<h2>Bonjour !</h2>
			<p>
				Bienvenue sur MégaSondage, le site qui vous propose de créer et de répondre à des sondages en ligne ! <br/>
				Nous utilisons le principe du système électoral à préférences multiples ordonnées, 
				qui  consiste à demander non pas seulement son option préférée, mais le classement complet de toutes ses préférences.<br>
				Bonne visite !
			</p>
		</div>
		<div id="hautDroit">
			<form method="post" action="index.php?p=connexion">
				<div><h2>Connexion</h2></div>
				<p>Connectez-vous pour accéder à votre compte personnel</p>
				<input type="text" name="email" placeholder="E-mail" onblur="verifMail(this)"><br/>
				<input type="password" name="mdp" placeholder="Mot de passe"><br/>
				<input type="submit" name="connexion" value="Se connecter" class="boutonRouge"><br/>
			</form>

			<?php

			if(isset($messageConnexion))
			{
				echo $messageConnexion;
			}

			?>

		</div>
		<div id="basGauche">
			<h2>Sondages publics</h2>
			<div class="todo">
				<b>TODO</b>
				Afficher quelques sondages publics et un lien "Plus de sondages..." qui redirige vers un page affichant tous les sondages publics
			</div>
			<a style="margin-left:15px;" class="boutonRouge" href="index.php?v=listeSondagesPublics">Tous les sondages publics</a>
		</div>
		<div id="basDroit">
			<form method="post" action="index.php?p=inscription">
				<div><h2>Inscription</h2></div>
				<p>Pas encore de compte ? Remplissez les champs</p>
				<input type="text" name="email" placeholder="Votre adresse mail" onblur="verifMail(this)" /><br/>
				<input type="text" name="pseudo" placeholder="Votre pseudo"/><br/>
				<input type="password" name="mdp" placeholder="Votre mot de passe" /><br/>
				<input type="submit" name="inscription" value="S'inscrire" class="boutonRouge" /><br/>
			</form>

			<?php

			if(isset($messageInscription))
			{
				echo $messageInscription;
			}

			?>
		</div>
	</div>
</body>

</html>