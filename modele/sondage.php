<?php

$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
//$bdd = new PDO('mysql:dbname=projetweb;host=localhost', 'root', 'fac2014');

class sondage{

	private $idSondage;
	private $titreSondage;
	private $descriptionSondage;
	private $dateFinSondage;
	private $idAdminstrateur;
	private $idType;

	public function __construct($id,$titre,$desc,$dateFin,$idAdmin,$idType){
		$this->idSondage=$id;
		$this->titreSondage=$titre;
		$this->descriptionSondage=$desc;
		$this->dateFinSondage=$dateFin;
		$this->idAdminstrateur=$idAdmin;
		$this->idType=$idType;

	}


	// -----------------------Getters------------------------------

	public function getIdSondage(){
		return $this->idSondage;
	}

	public function getTitreSondage(){
		return $this->titreSondage;
	}

	public function getDescriptionSondage(){
		return $this->descriptionSondage;
	}

	public function getDateFinSondage(){
		return $this->dateFinSondage;
	}

	public function getIdAdminstrateur(){
		return $this->idAdminstrateur;
	}

	public function getIdType(){
		return $this->idType;
	}

	// -----------------------Setters------------------------------

	public function setTitreSondage($titre){
		$this->titreSondage=$titre;
	}

	public function setDescriptionSondage($desc){
		$this->descriptionSondage=$desc;
	}

	public function setDateFinSondage($date){
		$this->dateFinSondage=$date;
	}

	public function setIdAdminstrateur($idAdmin){
		$this->idAdminstrateur=$idAdmin;
	}

	public function setIdType($idT){
		$this->idType=$idT;
	}


	// ----------------------Fonctions-----------------------------


	/* ---------------Fonctions Générales---------------- */

	public function getTitreById($id){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$titre = $bdd->prepare('SELECT titreSondage FROM sondage WHERE idSondage = ?');
		$titre->execute(array($id));
		$row = $titre->fetch();
		return $row['titreSondage'];
	}

	public function getDescById($id){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$titre = $bdd->prepare('SELECT descriptionSondage FROM sondage WHERE idSondage = ?');
		$titre->execute(array($id));
		$row = $titre->fetch();
		return $row['descriptionSondage'];
	}

	public function getDateById($id){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$titre = $bdd->prepare('SELECT dateFinSondage FROM sondage WHERE idSondage = ?');
		$titre->execute(array($id));
		$row = $titre->fetch();
		return $row['dateFinSondage'];
	}

	public function getSondageById($id){
		$sondage = $bdd->prepare('SELECT * FROM sondage WHERE idSondage = ?');
		$sondage->execute(array($id));
		return new sondage($sondage[idSondage],$sondage[titreSondage],$sondage[descriptionSondage],$sondage[dateFinSondage],$sondage[idAdminstrateur],$sondage[idType]);
	}

	public function getSondageByName($titre){
		$sondage = $bdd->prepare('SELECT * FROM sondage WHERE titreSondage = ?');
		$sondage->execute(array($titre));
		return new sondage($sondage[idSondage],$sondage[titreSondage],$sondage[descriptionSondage],$sondage[dateFinSondage],$sondage[idAdminstrateur],$sondage[idType]);
	}

	public function getNbSondPub(){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$list = $bdd->prepare("SELECT * FROM sondage WHERE idType='1'");
		$list->execute();
		return $list->rowCount();
	}

	public function getNbSondSite(){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$list = $bdd->prepare("SELECT * FROM sondage WHERE idType='2'");
		$list->execute();
		return $list->rowCount();
	}

	public function getNbSondPrive($idUtil){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$list = $bdd->prepare("SELECT s.idSondage FROM sondage s, inscrit i WHERE i.idUtilisateur=? AND i.idSondage=s.idSondage");
		$list->execute(array($idUtil));
		return $list->rowCount();
	}

	public function getSondPrive($idUtil){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$list = $bdd->prepare('SELECT s.idSondage FROM sondage s, inscrit i WHERE i.idUtilisateur=? AND i.idSondage=s.idSondage');
		$list->execute(array($idUtil));
		$i=0;
		$array = array();
		while ($row = $list->fetch()){
			$array[$i]=$row['idSondage'];
			$i++;
		}
		return $array;
	}

	public function getNbSondGroupe($idUtil){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$list = $bdd->prepare("SELECT s.idSondage FROM sondage s, membre m, groupe g WHERE m.idUtilisateur = ? AND m.idGroupe = g.idGroupe AND g.idGroupe = s.idGroupe");
		$list->execute(array($idUtil));
		return $list->rowCount();
	}

	public function getSondGroupe($idUtil){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$list = $bdd->prepare("SELECT s.idSondage FROM sondage s, membre m, groupe g WHERE m.idUtilisateur = ? AND m.idGroupe = g.idGroupe AND g.idGroupe = s.idGroupe");
		$list->execute(array($idUtil));
		$i=0;
		$array = array();
		while ($row = $list->fetch()){
			$array[$i]=$row['idSondage'];
			$i++;
		}
		return $array;
	}


	public function getNbSond(){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$list = $bdd->prepare("SELECT * FROM sondage");
		$list->execute();
		return $list->rowCount();
	}

	public function getIdSondByType($idType){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$list = $bdd->prepare("SELECT idSondage FROM sondage WHERE idType=?");
		$list->execute(array($idType));
		$i = 0;
		$array = array();
		while ($row=$list->fetch()){
			$array[$i] = $row['idSondage'];
			$i++;
		}
		return $array;
	}

	public function getTypeSondageById($id){
		$sondage = $bdd->prepare('SELECT t.idTypeSondage, t.titreSondage FROM Type_Sondage t, Sondage s WHERE s.idSondage = ? AND s.idType = t.idTypeSondage');
		$sondage->execute(array($id));
		return array($sondage[idTypeSondage],$sondage[titreSondage]);
	}

	public function getTypeSondageByName($nom){
		$sondage = $bdd->prepare('SELECT t.idTypeSondage, t.titreSondage FROM Type_Sondage t, Sondage s WHERE s.titreSondage = ? AND s.idType = t.idTypeSondage');
		$sondage->execute(array($nom));
		return array($sondage[idTypeSondage],$sondage[titreSondage]);
	}

	public function addSondage($sondage){
		$sond = $bdd->prepare('INSERT INTO Sondage ('.' '.'?,?,?,?,?)');
		$sond->ecxecute(array($sondage[titreSondage],$sondage[descriptionSondage],$sondage[dateFinSondage],$sondage[idAdminstrateur],$sondage[idType]));
	}


	/* ------------Fonctions liées aux utilisateurs-------------*/

	// Retourne l'utilisateur qui est Administrateur du sondage $idSond
	public function getAdminSondageById($idSond){
		$sondage = $bdd->prepare("SELECT u.idUtilisateur FROM Utilisateur u, Sondage s WHERE s.idSondage = ? AND s.idAdminstrateur = u.idUtilisateur");
		$sondage->execute(array($idSond));
		if($sondage->rowCount() == 0){
			return NULL;
		}else{
			return $sondage[idUtilisateur];
		}
	}
	// Retourne l'utilisateur qui est Administrateur du sondage $titreSond
	public function getAdminSondageByName($titreSond){
		$sondage = $bdd->prepare("SELECT u.idUtilisateur FROM Utilisateur u, Sondage s WHERE s.titreSondage = ? AND s.idAdminstrateur = u.idUtilisateur");
		$sondage->execute(array($titreSond));
		if($sondage->rowCount() == 0){
			return NULL;
		}else{
			return $sondage[idUtilisateur];
		}
	}

	/* -----------Fonction liées au Options ----------------- */

	public function getNbOptionBySondId($id){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$option = $bdd->prepare("SELECT intituleOption FROM options WHERE idSondage = ?");
		$option->execute(array($id));
		return $option->rowCount();
	}

	// Retourne la liste des options associées au sondage $id
	public function getListOptionById($id){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$option = $bdd->prepare("SELECT intituleOption FROM options WHERE idSondage = ?");
		$option->execute(array($id));
		$i = 0;
		$array = array();
		while ($row=$option->fetch()){
			$array[$i] = $row['intituleOption'];
			$i++;
		}
		return $array;
	}

	// Retourne la liste des options associées au sondage $titre
	public function getListOptionByName($titre){
		$option = $bdd->prepare("SELECT o.intituleOption FROM options o, sondage s WHERE s.titreSondage = ? AND s.idSondage = o.idSondage");
		$option->execute(array($titre));
		return $option;
	}

	public function getIdOptionByIntitule($inti){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$option = $bdd->prepare("SELECT idOption FROM options WHERE intituleOption = ?");
		$option->execute(array($inti));
		$row=$option->fetch();
		return $row['idOption'];
	}

	public function getSondUtiById($idUti){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$nb = $bdd->prepare('SELECT idSondage FROM sondage WHERE idAdministrateur=?');
		$nb->execute(array($idUti));
		$i=0;
		$array= array();
		while($row = $nb->fetch()){
			$array[$i]=$row['idSondage'];
			$i++;
		}
		return $array;
	}

	public function getNameById($id){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$nom = $bdd->prepare('SELECT titreSondage FROm sondage WHERE idSondage = ?');
		$nom->execute(array($id));
		$name = $nom->fetch();
		return $name['titreSondage'];

	}

	public function getSommeScore($idSondage,$nomOption){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$r1 =  $bdd->prepare('SELECT idOption FROM options WHERE intituleOption=?');
		$r1->execute(array($nomOption));
		$idOp = $r1->fetch();
		$val = $bdd->prepare("SELECT SUM(scoreVote) FROM vote WHERE idSondage = ? AND idOption = ?");
		$val->execute(array($idSondage,$idOp[0]));
		$row = $val->fetch();
		return $row[0];
	}
}

?>