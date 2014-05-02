<?php

class vote{
	private $idVote;
	private $scoreVote;
	private $idUtilisateur;
	private $idSondage;
	private $idOption;

	// Un constructeur
	public function __construct($id,$score,$idUti,$idSond,$idOpt){
		$this->idVote=$id;
		$this->scoreVote=$score;
		$this->idUtilisateur=$idUti;
		$this->idSondage=$idSond;
		$this->idOption=$idOpt;
	}


	// ------------------------Getters--------------------------

	public function getIdVote(){
		return $this->idVote;
	}

	public function getScoreVote(){
		return $this->scoreVote;
	}
	
	public function getIdUtilisateur(){
		return $this->idUtilisateur;
	}

	public function getIdSondage(){
		return $this->idSondage;
	}

	public function getIdOption(){
		return $this->idOption;
	}

	// ------------------------Setters---------------------------

	public function setScoreVote($score){
		$this->scoreVote = $score;
	}

	public function setIdUtilisateur($idUti){
		$this->idUtilisateur = $idUti;
	}

	public function setIdSondage($idSond){
		$this->idSondage =$idSond;
	}

	public function setIdOption($idOpt){
		$this->idOption=$idOpt;
	}

	// ---------------------Fonctions----------------------------

	public function getListVote(){
		$list=$bdd->prepare('SELECT * FROM vote');
		$list->execute();
		return $list;
	}

	public function getVoteById($id){
		$vote = $bdd->prepare('SELECT * FROM vote WHERE idVote = ?');
		$vote->execute(array($id));
		return $vote;
	}

	public function addVote($score,$idSond,$idOpt){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$vote = $bdd->prepare("INSERT INTO vote (scoreVote, idSondage, idOption) VALUES (?,?,?)");
		$vote->execute(array($score,$idSond,$idOpt));
	}

	public function addVoteInscrit($score,$idUti,$idSond,$idOpt){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$vote = $bdd->prepare('INSERT INTO vote (scoreVote,idUtilisateur,idSondage, idOption) VALUES (?,?,?,?)');
		$vote->execute(array($score,$idUti,$idSond,$idOpt));
	}

	public function getScoreVoteById($id){
		$score = $bdd->prepare('SELECT scoreVote FROM vote WHERE idVote = ?');
		$score->execute(array($id));
		return $score;
	}

	public function getNbOpt($idSond){
		$bdd = new PDO('mysql:dbname=sbricas;host=venus', 'sbricas', 'sbricas');
		$nb = $bdd->prepare("SELECT COUNT(DISTINCT idOption) FROM options WHERE idSondage=?");
		$nb->execute(array($idSond));
		$row = $nb->fetch();
		return $row[0];
	}
}

?>