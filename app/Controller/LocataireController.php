<?php 
namespace App\Controller;
use \App;
use Core\Auth\DBAuth;
/**
* Author:Alain KIKOUN 
**/
 
class LocataireController extends AppController{
	public function __construct(){
		parent::__construct();
		$this->loadModel('locataires');
		$this->loadModel('locat_bails');
		$this->loadModel('bailleurs');
		$this->loadModel('patrimoines');
		/*
		$this->loadModel('zone');*/
	}


	public function editMdp(){

		$this->islogged();

		if(!empty($_POST)){	
			if(isset($_POST["editpasse"])){
				if(
					$_POST["votremail"]!==""
					&& $_POST["ancmdp"]!==""
					&& $_POST["nouvmdp"]!==""
					&& $_POST["confnouvmdp"]!==""
				){
					if($_POST["nouvmdp"]===$_POST["confnouvmdp"]){
						if(strlen(trim($_POST["nouvmdp"]))>=9){
							$usermail=$_POST["votremail"];
							$userpass=$_POST["ancmdp"];
							$basedd=App::getInstanceApp()->getDatabase();

							$userquery=$basedd->dbPrepare("SELECT idlocataires, iduniq_locataires, mail_locataires, mdpass_locataires FROM locataires WHERE mail_locataires=?", [$usermail], null, true);
							if($userquery){
								//if($userpass===$userquery->mdpass_locataires){
								/**/
									if(password_verify($userpass, $userquery->mdpass_locataires))
									{
										$idloc= $userquery->idlocataires;
										/*cle passwor inject*/
										$options = ['cost' => 12,];
										$passwd = $_POST["nouvmdp"];
										/*!!! cle passwor inject*/
										$majpass=$this->locataires->update($idloc,[
										'mdpass_locataires'=> password_hash(
															$passwd,
															PASSWORD_BCRYPT,
															$options),
										'ckl'	=> $passwd
										]);
										if($majpass){
											$successMSG="Mot de Passe mis à jour avec succès !";
											header('refresh:2,index.php?p=locataire.compteconnected');
										}else{ $errMSG="Mise &agrave; jour impossible. Nouvelle tentative plus tard !";}
										
									}else{ $warningMSG=" Erreur de donn&eacute;es. Vous n'&ecirc;tes pas le titulaire de ce compte ?";}
							}else{$errMSG="Nouveau Passe et Confirmation Passe différents !";}
						}else{$errMSG="Votre mot de passe doit contenir au moins 9 caractères alphanum&eacute;riques !";}
					}else{ $errMSG="Un champ est probablement demeur&eacute; vide !";}
				
				}
			}
		}if(isset($errMSG)){
			$this->render("locataire.modifmdp", compact('errMSG'));
		}elseif(isset($warningMSG)){
			$this->render("locataire.modifmdp", compact('warningMSG'));
		}elseif(isset($successMSG)){
			$this->render("locataire.modifmdp", compact('successMSG'));
		}else{
			$this->render("locataire.modifmdp");
		}
		
	}

	/*public function connexion(){		
		if(!empty($_POST)){	
			if(isset($_POST["connexionof"])){				
				$auth=new DBAuth(\App::getInstanceApp()->getDatabase());
				$username=trim(htmlspecialchars($_POST['username'])); $password=trim(htmlspecialchars($_POST['password']));
				var_dump($auth->loginlocataire($username, $password));
				if($auth->loginlocataire($username, $password)){
					$successMSG="Connexion en cours...";
					header('refresh:2,index.php?p=locataire.compteconnected');		
				}else{ 
					$errMSG="Identifiant ou Mot de passe erroné!";}
			}
		}
		if(isset($errMSG)){
			$this->render("connexion.loginlocataire",compact('errMSG'));
		}elseif(isset($successMSG)){
			$this->render("connexion.loginlocataire",compact('successMSG'));
		}else{
			$this->render("connexion.loginlocataire");
		}
			
	}*/


	public function connexion(){		
		if(!empty($_POST)){	
			if(isset($_POST["connexionof"])){				
				$auth=new DBAuth(\App::getInstanceApp()->getDatabase());
				$username=trim(htmlspecialchars($_POST['username'])); $password=trim(htmlspecialchars($_POST['password']));
				if($auth->loginlocataire($username, $password)){
					$successMSG="Connexion en cours...";
					header('refresh:3,index.php?p=locataire.compteconnected');		
				}else{ 
					$errMSG="Identifiant ou Mot de passe erroné!";}
			}
		}
		if(isset($errMSG)){
			$this->render("connexion.loginlocataire",compact('errMSG'));
		}elseif(isset($successMSG)){
			$this->render("connexion.loginlocataire",compact('successMSG'));
		}else{
			$this->render("connexion.loginlocataire");
		}
			
	}


	public function compteConnected(){
		$this->islogged();
		$lelocataire=$this->locataires->findById($_SESSION['locataire_id']);
		if(isset($errMSG)){
			$this->render("locataire.compteopen", compact('lelocataire', 'errMSG'));
		}elseif(isset($successMSG)){
			$this->render("locataire.compteopen", compact('lelocataire', 'successMSG'));
		}else{
			$this->render("locataire.compteopen", compact('lelocataire'));
		}
					
	}

	public function islogged(){
		$app=App::getInstanceApp();
		$db= $app->getDatabase();
		
		$auth=new DBAuth($db);

		if(!$auth->locatairelogged())
		{
			header('Location:index.php?p=locataire.connexion');
		}
	}

	public function lostPass(){
		if(!empty($_POST)){	
			if(isset($_POST["renewpass"])){
				if(isset($_POST["usermail"])){
					$mail=trim($_POST["usermail"]);
					$okmail=$this->managers->isMailExist($mail);
					
					if($okmail){
						#generer key
						$tokenkey=sha1(rand());
						$idmanagers=$okmail->ordermanagers;

						$replylink="http://www.infoci.info/?p=managers.verifsuitk&listr=".$tokenkey;

						# Ajout key base de données						
						$tobd=$this->managers->update($idmanagers,[
							'manager_token'			=>	$tokenkey,
							'datemodif' 	=>	date('Y-m-d H:i:s')
						]);
						//var_dump($tobd);

						#envoi de mail
						$maildest=$okmail->manager_email;
						$nomdest=$okmail->manager_nom;
						$objet="Génération Nouveau Mot de Passe";
						$contenuMsg="Bonjour &nbsp;". $nomdest.",<br> 
						Veuillez cliquer sur le lien suivant pour générer un nouveau mot de passe  : ".$replylink. "<br><br>
						NB: Il est fortement conseillé de garder confidentiel son mot de passe. 
						Aussi, le changer périodiquement est-il nécessaire !<br> <br> <b></i>infoci.info</i>, La Com Simplement !</b>";
						$contenuMsg=str_replace("\n.", "\n..", $contenuMsg);
						$from_name="infoci.info";
						

						$from_mail="noreply@infoci.info";//Not reply;
						$encoding = "utf-8";
							 // Mail header
						$header = 'Content-type: text/html; charset='.$encoding."\r\n";
						$header .= 'From: '.$from_name.'<'.$from_mail.'>'."\r\n";
						$header .= 'To:'.$maildest."\n";
						$header .= 'MIME-Version: 1.0'."\r\n";
						$header .= 'Content-Transfer-Encoding: 8bit'."\r\n";
						$header .= 'Date:'.date("r (T)")." \r\n";
						$tomail=mail($maildest, $objet, $contenuMsg, $header);
						//if($tobd){$successMSG="cle ajoute a base de donnees !";}
						#envoi key par mail header() mail expediteur:pas_repondre@location.ci
						
						if($tobd && $tomail){$successMSG=" Merci de consulter vos mails pour la procédure de génération d'un nouveau mot de passe !";}else{$errMSG="OOOP une erreur est survenue. Veuillez essayer plus tard !"; }

					}else{$errMSG="Aucun compte ne correspond à ce mail !";}
				}else{$errMSG="Donnez un mail correct !";}
			}
		}if(isset($errMSG)){
			$this->render("locataire.lostpasstpl", compact('errMSG'));
		}elseif(isset($successMSG)){
			$this->render("locataire.lostpasstpl", compact('successMSG'));
		}else{
			$this->render("locataire.lostpasstpl");
		}
		
	}


	public function readMore(){
		$this->islogged();
		if(isset($_GET['suitable'])) 
			$idread=$_GET['suitable'];
		$oneInfo=$this->eventable->findById($idread);
		$this->render("annonces.lireplus", compact('oneInfo'));
	}


	public function bailleursListe(){
		$this->islogged();
		$idlocataire=$this->locataires->findById($_SESSION['locataire_id'])->iduniq_locataires;
		$toubailleurs=$this->locataires->mesbailleurs($idlocataire);
		if (isset($_GET['pageno'])) {
	        $pageno = $_GET['pageno'];
	    } else {
	        $pageno = 1;
	    }
	    $no_of_records_per_page = 12;
	    $offset = ($pageno-1) * $no_of_records_per_page;
	    $total_pages = ceil(count($toubailleurs) / $no_of_records_per_page);
		$bailleurListe=$this->locataires->paginatelocataire($idlocataire,$offset,$no_of_records_per_page);
		if(empty($bailleurListe)){
			$warningMSG="Vous n'avez aucun bailleur Affiché pour l'instant !";
		}

		$lelocataire=$this->locataires->findById($_SESSION['locataire_id']);

		if(isset($warningMSG)){
			$this->render("locataire.mesbailleurs", compact('warningMSG', 'lelocataire', 'bailleurListe'));
		}else{
			$this->render("locataire.mesbailleurs", compact('pageno', 'total_pages', 'bailleurListe', 'lelocataire'));
		}
	}
}




