<?php

//$bdd = new PDO('mysql:dbname=projetweb;host=localhost', 'root', 'fac2014');

class utilisateur{

	private $idUtilisateur;
	private $pseudoUtilisateur;
	private $passUtilisateur;
	private $mailUtilisateur;

	// Un constructeur
	public function __construct($id,$pseudo,$pass,$mail){

		$this->idUtilisateur=$id;
		$this->pseudoUtilisateur=$pseudo;
		$this->passUtilisateur=$pass;
		$this->mailUtilisateur=$mail;

	}

	// --------------------Getters-------------------------

	public function getIdUtilisateur(){
		return $this->idUtilisateur;
	}

	public function getPseudoUtilisateur(){
		return $this->pseudoUtilisateur;
	}

	public function getPassUtilisateur(){
		return $this->passUtilisateur;
	}

	public function getMailUtilisateur(){
		return $this->mailUtilisateur;
	}

	// ------------------Setters----------------------------

	public function setPseudoUtilisateur($pseudo){
		$this->pseudoUtilisateur=$pseudo;
	}

	public function setMailUtilisateur($mail){
		$this->mailUtilisateur=$mail;
	}


	/* ----------------------Fonctions--------------------------- */

	// -------Fonction Generale----------

	public function cryptPass($pass){
		return md5($pass);
	}

	public static function getUtiById($id){
		$user = $bdd->prepare('SELECT * FROM utilisateur WHERE idUtilisateur=?');
		$user->execute(array($id));

		return new utilisateur($user[idUtilisateur],$user[pseudoUtilisateur],$user[passUtilisateur],$user[mailUtilisateur]);
	}

	public function getPseudoUtiById($id){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$user = $bdd->prepare('SELECT pseudoUtilisateur FROM utilisateur WHERE idUtilisateur = ?');
		$user->execute(array($id));
		$row = $user->fetch();
		return $row['pseudoUtilisateur'];
	}

	public function getIdUtiByMail($mail){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$user = $bdd->prepare('SELECT idUtilisateur FROM utilisateur WHERE mailUtilisateur = ?');
		$user->execute(array($mail));
		$row = $user->fetch();
		return $row['idUtilisateur'];
	}

	public function getListUtilisateur(){
		$list = $bdd->prepare("SELECT * FROM utilisateur");
		$list->execute();
		return $list;
	}

	/* Ajoute un utilisateur à la base de données en cryptant le mot de passe et en verifiant que l'utilisateur n'existe pas déjà */
	public function addUtilisateur($pseudo,$pass,$mail){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$test=$bdd->prepare('SELECT idUtilisateur FROM utilisateur WHERE mailUtilisateur = ?');
		$test->execute(array($mail));
		echo $test->rowCount();
		if ($test->rowCount() == 0){
			$add = $bdd->prepare("INSERT INTO utilisateur(pseudoUtilisateur, passUtilisateur, mailUtilisateur) VALUES (?,?,?)");
			$add->execute(array($pseudo,md5($pass),$mail));
			return 1;
		}
		else {
			return -1;
		}
	}

	public function deleteUtilisateurById($id){
		$del = $bdd->prepare('DELETE FROM utilisateur WHERE idUtilisateur = ?');
		$del->execute(array($id));
	}

		/*Modifie le pseudo de l'utilisateur
	  return :
	  	0 si mise à jour réussi
	  	1 si pseudo déja utilisé
	*/ 
	public function updatePseudo($pseudoAncien,$pseudoNouv){
		$test = $bdd->prepare('SELECT idUtilisateur FROM utilisateur WHERE pseudoUtilisateur = ?');
		$test->execute(array($pseudoNouveau));
		if($test->rowCount() == 0){
			$update = $bdd->prepare('UPDATE utilisateur SET pseudoUtilisateur = ? WHERE pseudoUtilisateur=?');
			$update->execute(array($pseudoNouveau,$pseudoAncien));
			return 0;

		}else{
			return 1;
		}
	}

	public function bonIdent($mail,$pass){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$mdp = md5($pass);
		$test =$bdd->prepare('SELECT idUtilisateur FROM utilisateur WHERE (mailUtilisateur = ? AND passUtilisateur = ?)');
		$test->execute(array($mail,$mdp));
		if ($test->rowCount() == 0){
			return false;
		}else{
			return true;
		}
	}

	// --------Fonctions liées au Sondage---------

	/* retourne vrai si l'utilisateur est Adminstrateur, faux sinon */
	public function isAdminById($id){
		$réponse = $bdd->prepare('SELECT S.idSondage FROM sondage S, utilisateur U WHERE U.idUtilisateur = ? AND U.idUtilisateur = S.idAdministrateur');
		$reponse->execute(array($id));
		if ($reponse->rowCount() == 0){ // si il n'y a pas de ligne (=0), l'utilisateur n'est pas administrateur
			return false;
		}else{
			return true;
		}
	}


	/* retourne vrai si l'utilisateur est Adminstrateur, faux sinon */
	public function isAdminByName($nom){
		$réponse = $bdd->prepare('SELECT S.idSondage FROM sondage S, utilisateur U WHERE U.pseudoUtilisateur = ? AND U.idUtilisateur = S.idAdministrateur');
		$reponse->execute(array($nom));
		if ($reponse->rowCount() == 0){ // si il n'y a pas de ligne (=0), l'utilisateur n'est pas administrateur
			return false;
		}else{
			return true;
		}
	}

	/* retourne la liste des sondages aux quels l'utilisateur $id est inscrit */
	public function getListInscrUtiById($id){
		$list= $bdd->prepare('SELECT S.idSondage, S.titreSondage, S.descriptionSondage, S.dateFinSondage,S.idAdminstrateur, S.idType FROM Sondage S, Utilisateur U, Inscrit I WHERE U.idUtilisateur=? AND U.idUtilisateur=I.idUtilisateur AND I.idSondage = S.idSondage');
		$list->execute(array($id));
		return new Sondage($list[idSondage],$list[titreSondage],$list[descriptionSondage],$list[dateFinSondage],$list[idAdminstrateur],$list[idType]);
	}

	/* retourne la liste des sondages aux quels l'utilisateur $pseudo est inscrit */
	public function getListInscrUtiByName($pseudo){
		$list= $bdd->prepare('SELECT S.idSondage, S.titreSondage, S.descriptionSondage, S.dateFinSondage,S.idAdminstrateur, S.idType FROM Sondage S, Utilisateur U, Inscrit I WHERE U.pseudoUtilisateur=? AND U.idUtilisateur=I.idUtilisateur AND I.idSondage = S.idSondage');
		$list->execute(array($pseudo));
		return $list;
	}

	// -----------Fonctions liées au Votes-----------
	public function getListeVoteUtiById($id){
		$list=$bdd->prepare('SELECT * FROM vote WHERE idUtilisateur =?');
		$list->execute(array($id));
		return $list;
	}

	public function getListVoteUtiByName($pseudo){
		$list=$bdd->prepare('SELECT * FROM vote v, utilisateur u WHERE u.pseudoUtilisateur =? AND u.idUtilisateur = v.idUtilisateur');
		$list->execute(array($pseudo));
		return $list;
	}


	// ----------Fonctions liées au groupes ----------

	/* retourne la liste des groupes auquel appartient l'utilisateur */
	public function getlistGroupUtiById($id){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$group = $bdd->prepare('SELECT g.nomGroupe FROM groupe g, membre m WHERE m.idUtilisateur = ? AND m.idGroupe = g.idGroupe');
		$group->execute(array($id));
		$i = 0;
		$array = array();
		while ($row=$group->fetch()){
			$array[$i] = $row['nomGroupe'];
			$i++;
		}
		return $array;
	}

	public function getListGroupUtiByName($pseudo){
		$group = $bdd->prepare('SELECT * FROM groupe g, membre m, utilisateur u WHERE u.idUtilisateur = ? AND u.idUtilisateur=m.idUtilisateur AND m.idMembre = g.idMembre');
		$group->execute(array($id));
		return $group;
	}
	/* retourne vrai si l'utilisateur est moderateur, faux sinon */
	public function isModoById($id){
		$modo= $bdd->prepare('SELECT m.idModerateur FROM moderateur m, groupe g, membre mb WHERE mb.idUtilisateur=? AND mb.idGroupe = g.idGroupe AND g.idGroupe = m.idGroupe');
		$modo->execute(array($id));
		if($modo->rowCount() == 0){
			return false;
		}else{
			return true;
		}
	}

	public function isModoByName($pseudo){
		$modo=$bdd->prepare('SELECT m.idModerateur FROM moderateur m, groupe g, membre mb, utilisateur u WHERE u.pseudoUtilisateur =  ? AND u.idUtilisateur = mb.idUtilisateur AND mb.idGroupe = g.idGroupe AND g.idGroupe = m.idGroupe');
		$modo->execute(array($pseudo));
		if($modo->rowCount() == 0){
			return false;
		}else{
			return true;
		}
	}






}

?>