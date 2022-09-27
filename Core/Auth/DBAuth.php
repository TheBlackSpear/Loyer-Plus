<?php 
/**
* Author:Alain KIKOUN
**/
 ?>
<?php 
namespace Core\Auth;
use Core\Database\Database;

class DBAuth{

	private $db;
	//private $user_connected;

	public function __construct(Database $db){
		$this->db=$db;
	}

	public function getUserId(){
		if($this->logged()){
			return $_SESSION['connect'];
		}
		return false;
	}

	public function loginlocataire($username, $password){
		$userquery=$this->db->dbPrepare("SELECT idlocataires, iduniq_locataires, nom_locataires, mail_locataires, mdpass_locataires FROM locataires WHERE mail_locataires=? ", [$username], null, true);

		if($userquery){
			/*if($password===$userquery->mdpass_locataires){*/
			/*
			if(password_verify($password, $userquery->mdpass_locataires))
			{*/
				if(password_verify($password, $userquery->mdpass_locataires))
			{
				$passewd = $userquery->mdpass_locataires;				
				$_SESSION['locataire_id'] = $userquery->idlocataires;
				$_SESSION['locataire_mail'] = $userquery->mail_locataires;
				$_SESSION['nom_locataire'] = $userquery->nom_locataires;
				$_SESSION['pass_locataire'] = $passewd;
				return true;
			}  return false;
		}
	}

	public function loginbailleur($identifiant, $modepass){
		
		$recquery=$this->db->dbPrepare("SELECT idbailleurs, nom_bailleurs, mail_bailleurs, mdpass_bailleurs, iduniq_bailleurs FROM bailleurs WHERE mail_bailleurs=?", [$identifiant], null, true);

		if($recquery){
			/*if($modepass===$recquery->mdpass_bailleurs){*/
			/**/if(password_verify($modepass, $recquery->mdpass_bailleurs))
			{
				$passewrd = $recquery->mdpass_bailleurs;				
				$_SESSION['bailleur_id'] = $recquery->idbailleurs;
				$_SESSION['bailleur_nom'] = $recquery->nom_bailleurs;
				$_SESSION['bailleur_passwd'] = $recquery->mdpass_bailleurs;
				return true;
			}  return false;
		}
	}

	public function logged(){
		if(isset($_SESSION['logwbma'])){return isset($_SESSION['logwbma']);}
		
	}
	public function locatairelogged(){
		if(isset($_SESSION['locataire_id'])){return isset($_SESSION['locataire_id']);}
		
	}

	public function bailleur_logged(){
		if(isset($_SESSION['bailleur_id'])){return isset($_SESSION['bailleur_id']);}
		
	}
	
	public function deconnexion(){
		$cheminhors=explode('=', $_SERVER["REQUEST_URI"]);
		if($cheminhors[1]==='logout.accountclose') {
			if(isset($_SESSION['nom_locataire']) && isset($_SESSION['locataire_id'])){
				unset($_SESSION['locataire_mail']);
				unset($_SESSION['nom_locataire']);
				unset($_SESSION['locataire_id']);
				unset($_SESSION['pass_locataire']);
			}


		}elseif($cheminhors[1]==='logout.recrutclose') {
			if(isset($_SESSION['bailleur_nom']) && isset($_SESSION['bailleur_id'])){
				unset($_SESSION['bailleur_nom']);
				unset($_SESSION['bailleur_id']);
				unset($_SESSION['bailleur_passwd']);
			}
		}
	}
}