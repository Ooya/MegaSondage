<?php

class commentaire{
	private $idCommentaire;
	private $contenuCommentaire;
	private $idSondage;
	private $idParent;

	// Un constructeur
	public function __construct($id,$cont,$idSond,$idPar){
		$this->idCommentaire=$id;
		$this->contenuCommentaire=$cont;
		$this->idSondage=$idSond;
		$this->idParent=$idPar;
	}


	// ---------------------Getters-----------------------
	public function getIdCommentaire(){
		return $this->idCommentaire;
	}

	public function getContenuCommentaire(){
		return $this->contenuCommentaire;
	}

	public function getIdSondage(){
		return $this->idSondage;
	}

	public function getIdParent(){
		return $this->idParent;
	}

	// -----------------------Setters------------------------

	public function setContenuCommentaire($cont){
		$this->contenuCommentaire=$cont;
	}

	public function setIdSondage($sond){
		$this->idSondage=$sond;
	}

	public function setIdParent($par){
		$this->idParent=$par;
	}

	// -----------------------Fonctions-----------------------

	public function getListCommentaireById($id){
		$comment = $bdd->prepare('SELECT contenuCommentaire FROM Commentaire WHERE idCommentaire = ?');
		$comment->execute(array($id));
		return $comment;
	}

	public function getListCommentaireByIdSondage($idSond){
		$comment = $bdd->prepare('SELECT c.contenuCommentaire FROM Commentaire c, Sondage s WHERE s.idSondage = ? AND s.idSondage = c.idSondage');
		$comment->execute(array($idSond));
		return $comment;
	}

	public function getListCommantaire(){
		$list = $bdd->prepare('SELECT * FROM Commentaire');
		$list->execute();
		return $list;
	}

	// Attention si il y a deux titre de sondage similaire
	public function getListCommentaireByNameSondage($titre){
		$comment = $bdd->prepare('SELECT c.contenuCommentaire FROM Commentaire c, Sondage s WHERE s.titreSondage = ? AND s.idSondage = c.idSondage');
		$comment->execute(array($titre));
		return $comment;
	}
}

?>