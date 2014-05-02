<?php

class groupe{
	private $idGroupe;
	private $nomGroupe;
	private $idAdministrateur;

	// Un Constructeur
	public function __construct($id,$nom,$idAdmin){
		$this->idGroupe=$id;
		$this->nomGroupe=$nom;
		$this->idAdminstrateur=$idAdmin;
	}

	/* ----------------- Getters ------------------ */
	public function getIdGroupe(){
		return $this->idGroupe;
	}

	public function getNomGroupe(){
		return $this->nomGroupe;
	}

	public function getIdAdministrateur(){
		return $this->idAdminstrateur;
	}

	/* ---------------- Setters ------------------- */
	public function setIdGroupe($id){
		$this->idGroupe=$id;
	}

	public function setNomGroupe($nom){
		$this->nomGroupe=$nom;
	}

	public function setIdAdministrateur($idAdmin){
		$this->idAdministrateur=$idAdmin;
	}

	/* --------------- Fonctions générales ---------- */

	public function getTypeGroupeById($id){
		$type = $bdd->prepare('SELECT t.nomTypeGroupe FROM Type_Groupe t, Groupe g WHERE g.idGroupe = ? AND g.idType=t.idTypeGroupe');
		$type->execute(array($id));
		return $type;
	}

	public function getTypeGroupeByName($nom){
		$type =$bdd->prepare('SELECT t.nomTypeGroupe FROM TypeGroupe t, Groupe g WHERE g.nomGroupe = ? AND g.idType=t.idTypeGroupe');
		$type->execute(array($nom));
		return $type;
	}

	public function getModoGroupeById($id){
		$modo = $bdd->prepare('SELECT u.pseudoUtilisateur FROM Utilisateur u, Membre m, Groupe g, Moderateur d WHERE g.idGroupe = ? AND g.idAdminstrateur = d.idModerateur AND d.idMembre = m.idMembre AND m.idUtilisateur = u.idUtilisateur');
		$modo->execute(array($id));
		return $modo;
	}

	public function getModoGroupeByName($nom){
		$modo = $bdd->prepare('SELECT u.pseudoUtilisateur FROM Utilisateur u, Membre m, Groupe g, Moderateur d WHERE g.nomGroupe = ? AND g.idAdminstrateur = d.idModerateur AND d.idMembre = m.idMembre AND m.idUtilisateur = u.idUtilisateur');
		$modo->execute(array($nom));
		return $modo;
	}

	public function getAdminGroupeById($id){
		$admin = $bdd->prepare('SELECT u.pseudoUtilisateur FROM Utilisateur u, Membre m, Groupe g WHERE g.idGroupe = ? AND g.idAdminstrateur = m.idMembre AND m.idUtilisateur = u.idUtilisateur');
		$admin->execute(array($id));
		return $admin;
	}

	public function getAdminGroupeByName($nom){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$admin = $bdd->prepare('SELECT u.pseudoUtilisateur FROM utilisateur u, membre m, groupe g WHERE g.nomGroupe = ? AND g.idAdminstrateur = m.idMembre AND m.idUtilisateur = u.idUtilisateur');
		$admin->execute(array($nom));
		$row = $admin->fetch();
		return $row[0];
	}

	public function getListGroupe(){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$list=$bdd->prepare('SELECT nomGroupe FROM groupe');
		$list->execute();
		$i = 0;
		$array = array();
		while ($row=$list->fetch()){
			$array[$i] = $row['nomGroupe'];
			$i++;
		}
		return $array;
	}

	public function addMembre($nomGroupe, $idUtil){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$id = $bdd->prepare('SELECT idGroupe FROM groupe WHERE nomGroupe = ?');
		$id->execute(array($nomGroupe));
		$row = $id->fetch();
		$inser = $bdd->prepare('INSERT INTO membre (idUtilisateur, idGroupe) VALUES (?,?)');
		$inser->execute(array($idUtil, $row[0]));
	}




}

?>