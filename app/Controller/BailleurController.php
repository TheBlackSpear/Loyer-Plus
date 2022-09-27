<?php 
namespace App\Controller;
use \App;
use Core\Auth\DBAuth;
use App\Upload\Uplogo;
use App\Upload\UploadPdf;

/**
* Author:Alain KIKOUN 
**/
 
class BailleurController extends AppController{
	public function __construct(){
		parent::__construct();
		$this->loadModel('identites');
		$this->loadModel('villes');
		$this->loadModel('bailleurs');
		$this->loadModel('patrimoines');
		$this->loadModel('locataires');
		$this->loadModel('locat_bails');
		//$this->loadModel('payements');
	}

/*============CREER SON COMPTE==================*/
	public function inscription(){

		if(isset($_SESSION['bailleur_id'])){
			header('Location:?p=bailleur.compteconnected');
		}
		if(isset($_POST) && !empty($_POST)){
			if(isset($_POST["valideform"])){
				$length=5;
				$codes=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
				$iduniq_bailleurs	= 	"bailleur".date('Ymd').$codes;
				$civil_bailleurs	=	trim(htmlspecialchars(htmlentities($_POST['civilite_bail'])));
				$nom_bailleurs		=	trim(htmlspecialchars(htmlentities($_POST['nom_bail'])));
				$prenom_bailleurs	=	trim(htmlspecialchars(htmlentities($_POST['prenom_bail'])));
				$phone_bailleurs	=	trim(htmlspecialchars(htmlentities($_POST['phone_bail'])));
				$mail_bailleurs		=	trim(htmlspecialchars(htmlentities($_POST['mail_bail'])));
				$mdPass_bailleurs	=	trim(htmlspecialchars(htmlentities($_POST['motdepasse_bail'])));
				$mdfpass_conf	=	trim(htmlspecialchars(htmlentities($_POST['conf_motdepasse_bail'])));
				//$mdPass_bailleurs	=	sha1($pass_sent_by_mail);
				if(
					$civil_bailleurs !=='' 
					&& $nom_bailleurs !=='' 
					&& $prenom_bailleurs !==''
					&& $phone_bailleurs !=='' 
					&& $mail_bailleurs !=='' 
					&& $mdPass_bailleurs !=='' 
					&& $mdfpass_conf!==''
					){	
						if(strlen(trim($mdPass_bailleurs))>=9){			
							$options = ['cost' => 12,];
							$mypswd = $mdPass_bailleurs;
							$bailleurcreate=$this->bailleurs->create([
								'iduniq_bailleurs'		=>	"bailleur-".md5(rand()),
								'civil_bailleurs'		=> 	$civil_bailleurs,
								'nom_bailleurs'		=> 	$nom_bailleurs,
								'prenoms_bailleurs'	=>	$prenom_bailleurs,
								'phone_bailleurs'	=> 	$phone_bailleurs,
								'mail_bailleurs'		=> 	$mail_bailleurs,
								'mdpass_bailleurs'		=> password_hash( $mypswd, PASSWORD_BCRYPT,	$options),
								'added_at'=>date("Y-m-d"),
								'updated_at'=>date("Y-m-d")
								]);


							/* ENVOI D'UN MAIL DE CONFIRMATION*/
												#envoi de mail
							$maildest=$mail_bailleurs;
							$nomdest=$nom_bailleurs;
							$objet="***CREATION de compte***";
							$contenuMsg="Bonjour &nbsp;". $nomdest.",<br>  votre compte a été créé avec succès. <b> Mail:</b> ".$maildest. " || Mot de passe: " .$mypswd. " 
							<br><br>NB: Il est fortement conseillé de garder confidentiel son mot de passe.";
							$contenuMsg=str_replace("\n.", "\n..", $contenuMsg);
							$from_name="Loyer Plus";

							$from_mail="noreply@simplonien-da.net";//Not reply;
							$encoding = "utf-8";
								 // Mail header
							$header = 'Content-type: text/html; charset='.$encoding."\r\n";
							$header .= 'From: '.$from_name.'<'.$from_mail.'>'."\r\n";
							$header .= 'To:'.$maildest."\n";
							$header .= 'MIME-Version: 1.0'."\r\n";
							$header .= 'Content-Transfer-Encoding: 8bit'."\r\n";
							$header .= 'Date:'.date("r (T)")." \r\n";
							$tomail=mail($maildest, $objet, $contenuMsg, $header);
												
							if($bailleurcreate && $tomail){
								$successMSG=" La création de votre compte, en tant que bailleur, est effective !";
								header('refresh:3,?p=bailleur.loginForm');
								$this->render("annonces.rdvvalid", compact('successMSG'));
								exit;
							}else{
								$errMSG="OOOP une erreur est survenue. Veuillez essayer plus tard !"; 
							}	
						}else{$errMSG="Votre mot de passe doit contenir au moins 9 caractères alphanum&eacute;riques !";}			
				}else{$errMSG="Au moins un champ est vide. Veuillez remplir à nouveau le formulaire !";}
			}
		}
		if(isset($errMSG)){
			$this->render("bailleur.forminscription", compact('errMSG'));
		}elseif(isset($successMSG)){
			$this->render("bailleur.forminscription", compact('successMSG'));
		}else{
			$this->render("bailleur.forminscription");
		}	
	}


	public function verifsuitk(){
		if(isset($_GET["listr"])){	
			if($_GET["listr"]!==""){
				$cletoken=$_GET["listr"];
				$iskey=$this->recruteur->keyExist($cletoken);				
				if($iskey){
					if(!empty($_POST)){
						if(isset($_POST["editnewpass"])){
							if(trim($_POST["newpassword"])!=="" && trim($_POST["confpassword"])!==""){
								$nPass=trim($_POST["newpassword"]);
								$cPass=trim($_POST["confpassword"]);
								if($nPass===$cPass){
									if(strlen($nPass)>=9){
								//$long = strlen($_POST["passowner"]);
									/**/$options = ['cost' => 12,];
									$npassHide = $nPass;
									$newPass = password_hash(
										$npassHide,
										PASSWORD_BCRYPT,
										$options
									);		
									$idrecs=$iskey->orderrecruteurs;
									#Update mot de passe en base de données
									$maj=$this->recruteur->update($idrecs,[
									"rpswd"=>$newPass,
									"datemodif"=>date('Y-m-d H:i')
									]);
															
									#envoi de mail
									$maildest=$iskey->rmail;
									$nomdest=$iskey->rnom;
									$objet="Votre Nouveau Mot de Passe";
									$contenuMsg="Bonjour &nbsp;". $nomdest.",<br>
									 Vous avez généré votre nouveau mot de passe avec succès. <br> 
									 NB: il est fortement conseillé de garder confidentiel ce mot de passe.
									  Aussi, le changer périodiquement est-il nécessaire !<br> <br>
									   <b></i>infoci.info</i>, La Com Simplement !</b>";
									$contenuMsg=str_replace("\n.", "\n..", $contenuMsg);
									$from_name="infoci.info";
									$from_mail="noreply@infoci.info";
									$encoding = "utf-8";
									 // Mail header
								    $header = 'Content-type: text/html; charset='.$encoding."\r\n";
								    $header .= 'From: '.$from_name.'<'.$from_mail.'>'."\r\n";
								    $header .= 'To:'.$maildest."\n";
								    $header .= 'MIME-Version: 1.0'."\r\n";
								    $header .= 'Content-Transfer-Encoding: 8bit'."\r\n";
								    $header .= 'Date:'.date("r (T)")." \r\n";
							    	
							    	  // Send mail
								    $envoiMsg=mail($maildest, $objet, $contenuMsg, $header);
								//if($envoiMsg && $maj){$successMSG="Votre nouveau mot de passe a été généré et envoyé par mail !";}else{$errMSG="Echec de génération du nouveau mot de passe !"; }
								    if($maj && $envoiMsg){
								    	$tokentoZero=$this->recruteur->update($idrecs,[
									"recruteur_token"=>0,
									"update_at"=>date('Y-m-d H:i')
									]);
								    	$successMSG="Votre nouveau mot de passe a été généré !";
								    }
								    }else{$errMSG="Votre mot de passe doit contenir au moins 9 caractères alphanum&eacute;riques !";}
									}else{ $errMSG="Nouveaux Mots de Passe différents !";}
								
							}else{ $errMSG="Au moins un champ est vide !";}
						}
						#
					}
				}else{
					$errMSG="OOOP, Ce lien a expiré <br> veuillez en générer un nouveau !";
					header('refresh:5,?p=jobrecruteurci.lostPass');
				}
			}
		}if(isset($errMSG)){
			$this->render("recruteur.newpass", compact('errMSG'));
		}elseif(isset($successMSG)){
			$this->render("recruteur.newpass", compact('successMSG'));
		}else{
			$this->render("recruteur.newpass");
		}
		
 
	}

/*===========!=CREER  ET GERER SON COMPTE==================*/


/*===========!=CONNEXION A SON COMPTE==================*/
	public function loginForm(){		
		if(!empty($_POST)){	
			if(isset($_POST["connexionof"])){				
				$auth=new DBAuth(\App::getInstanceApp()->getDatabase());
				$username=trim(htmlspecialchars($_POST['username'])); $password=trim(htmlspecialchars($_POST['password']));
				if($auth->loginbailleur($username, $password)){
					$successMSG="Connexion en cours...";
					header('refresh:2,index.php?p=bailleur.compteconnected');		
				}else{ 
					$errMSG="Identifiant ou Mot de passe erroné!";}
			}
		}
		if(isset($errMSG)){
			$this->render("connexion.loginrec",compact('errMSG'));
		}elseif(isset($successMSG)){
			$this->render("connexion.loginrec",compact('successMSG'));
		}else{
			$this->render("connexion.loginrec");
		}
				
	}

	public function compteConnected(){
		$this->islogged();
		if(isset($_POST["majform"])){
			if($_POST["phone_bailleur"]!=="" && $_POST["mail_bailleur"]!==""){
				$idrec=$_SESSION["bailleur_id"];
				$orderma=$this->bailleurs->getById($idrec)->idbailleurs;
				$valider=$this->bailleurs->update($orderma, [
					'phone_bailleurs'=>$_POST["phone_bailleur"],
					'mail_bailleurs'=>$_POST["mail_bailleur"],
					'updated_at'=>date("Y-m-d H:i")
				]);
				if ($valider) {
					$successMSG="Mise à jour réussie !";
				}else{$errMSG="Mise à jour échouée !"; }
			}else{$errMSG="L'un des champs est vide !"; }
		}
		$lebailleur=$this->bailleurs->findById($_SESSION['bailleur_id']);
		if(isset($errMSG)){
			$this->render("bailleur.compteopen", compact('lebailleur', 'errMSG'));
		}elseif(isset($successMSG)){
			$this->render("bailleur.compteopen", compact('lebailleur', 'successMSG'));
		}else{
			$this->render("bailleur.compteopen", compact('lebailleur'));
		}
					
	}


/*===========!=CONNEXION A SON COMPTE==================*/

	public function islogged(){
		$app=App::getInstanceApp();
		$db= $app->getDatabase();
		
		$auth=new DBAuth($db);

		if(!$auth->bailleur_logged())
		{
			header('Location:index.php?p=bailleur.loginForm');
		}
	}

	public function lostPass(){
		if(!empty($_POST)){	
			if(isset($_POST["renewpass"])){
				if(isset($_POST["usermail"])){
					$mail=trim($_POST["usermail"]);
					$okmail=$this->jobrecruteur->isMailExist($mail);
					
					if($okmail){
						#generer key
						$tokenkey=sha1(rand());
						$idrecs=$okmail->orderjobrecruteur;

						$replylink="https://www.infoci.info/?p=jobrecruteurci.verifsuitk&listr=".$tokenkey;

						# Ajout key base de données						
						$tobd=$this->jobrecruteur->update($idrecs,[
							'recruteur_token'			=>	$tokenkey,
							'updated_at' 	=>	date('Y-m-d H:i')
						]);
						//var_dump($tobd);

						#envoi de mail
						$maildest=$okmail->rmail;
						$nomdest=$okmail->rnom;
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
			$this->render("recruteur.lostpasstpl", compact('errMSG'));
		}elseif(isset($successMSG)){
			$this->render("recruteur.lostpasstpl", compact('successMSG'));
		}else{
			$this->render("recruteur.lostpasstpl");
		}
		
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

							$userquery=$basedd->dbPrepare("SELECT idbailleurs, iduniq_bailleurs, mail_bailleurs, mdpass_bailleurs FROM bailleurs WHERE mail_bailleurs=?", [$usermail], null, true);
							if($userquery){
								/*if($userpass===$userquery->rpswd){
								*/

								if(password_verify($userpass, $userquery->mdpass_bailleurs))
								{
								
									$idbail= $userquery->idbailleurs;
									/*cle passwor inject*/
									$options = ['cost' => 12,];
									$passwd = $_POST["nouvmdp"];
									$pswdmaj=password_hash(
										$passwd, PASSWORD_BCRYPT, $options);
									/*$pswdmaj=$passwd;*/

									/*!!! cle passwor inject*/
									$majpass=$this->bailleurs->update($idbail,[
										'mdpass_bailleurs'=> $pswdmaj,
										'updated_at'=> date("Y-m-d")
									]);
									if($majpass){
										$successMSG="Mot de Passe mis à jour avec succès !";
										header('refresh:2,index.php?p=bailleur.compteconnected');
									}else{ $errMSG="Mise &agrave; jour impossible. Nouvelle tentative plus tard !";}
									
								}else{ $warningMSG=" Erreur de donn&eacute;es. Vous n'&ecirc;tes pas le titulaire de ce compte ?";} 

							}else{$errMSG="Certaines informations sont erronn&eacute;es ou problablement ce compte n'est pas le vôtre !";}
						}else{$errMSG="Votre mot de passe doit contenir au moins 9 caractères alphanum&eacute;riques !";}
					}else{ $errMSG="Nouveau Passe et Confirmation Passe différents !";}
				
				}else{ $errMSG="Un champ est probablement demeur&eacute; vide !";}
			}
		}

		$lerecruteur=$this->bailleurs->findById($_SESSION['bailleur_id']);
		if(isset($errMSG)){
			$this->render("bailleur.modifmdp", compact('errMSG', 'lerecruteur'));
		}elseif(isset($warningMSG)){
			$this->render("bailleur.modifmdp", compact('warningMSG', 'lerecruteur'));
		}elseif(isset($successMSG)){
			$this->render("bailleur.modifmdp", compact('successMSG', 'lerecruteur'));
		}else{
			$this->render('bailleur.modifmdp', compact('lerecruteur'));
		}
		
	}
	
	public function delete(){
		$this->islogged();

		if (isset($_GET["suitabledel"])) {
			$notrefichier=ROOT."/app/Upload/image_fichiers/infocimg/".$eventdata->event_img;
			if(file_exists($notrefichier)){
				if(is_file($notrefichier)){
					$delpict=unlink($notrefichier);
				}
			}
			$this->eventable->delete($nsid);
			echo "Suppression en cours...";
			//header('refresh:5,?p=annonce.compteConnected');
		}
	}
/*================CREER ET GERER DES OFFRES EMPLOI/STAGE==========*/

	public function plusMaison(){		
		//var_dump(date('Y-m-d', strtotime(date('Y-m-d'). '+1 DAY')));

		$this->islogged();

		if (isset($_POST["newmaison"])) {
			//ID de recruteur ou annonceur
			//$orbailleur=$this->bailleurs->findById($_SESSION["bailleur_id"])->idbailleurs;
			$clebailleur=$this->bailleurs->findById($_SESSION["bailleur_id"])->iduniq_bailleurs;
			//var_dump($clebailleur);
			if(
				$_POST["reference_porte"]!=="" 
				&& $_POST["ville"]!==""
				&& $_POST["loyer"]!==""
			){
					$length=5;
					$codes=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);	
					$ok=$this->patrimoines->create([
						'iduniq_pat'	=>	"maison-".date('YmdHi').$codes,
						'porte_num_pat'	=> 	$_POST["reference_porte"],
						'ville_id'	=> 	trim(htmlentities($_POST["ville"])),
						'loyer'	=>	trim(htmlentities($_POST["loyer"])),
						'bailleur_id'		=>$clebailleur,
						'statut'	=> 0
						//'datefin'		=>	date('Y-m-d', strtotime($datedefin. '+1 DAY'))		
					]);
					if($ok){
						$successMSG="Maison enregistr&eacute;e.!";
						/*$this->render("annonces.rdvvalid", compact('successMSG'));*/
						
						header('refresh:2,?p=bailleur.listMaison');
					}else{
						$errMSG="Echec enregistrement.";
					}
						
				//}else{ $errMSG="Texte des détails sur l'événement doit contenir 1400 caractères maximum !";}
			}else{$errMSG= "Au moins un champ est mal rempli !";}
		}		

		$lerecruteur=$this->bailleurs->findById($_SESSION['bailleur_id']);
		//var_dump($lerecruteur);
		$ville=$this->villes->all();
		if(isset($errMSG)){
			$this->render("bailleur.ajouter_maison", compact('ville','lerecruteur', 'errMSG'));
		}elseif(isset($successMSG)){
			$this->render("bailleur.ajouter_maison", compact('ville','lerecruteur', 'successMSG'));
		}else{
			$this->render("bailleur.ajouter_maison", compact('ville','lerecruteur'));
		}
		
	}


	public function plusLocataire(){	

		$this->islogged();

		$clebailleur=$this->bailleurs->findById($_SESSION['bailleur_id'])->iduniq_bailleurs;
		$nombailleur=$this->bailleurs->findById($_SESSION['bailleur_id'])->nom_bailleurs;

		if (isset($_POST["newlocataire"])) {
			//var_dump($_POST);
			if(isset($_POST['nom_locataires']) && isset($_POST['prenom_locataires']) &&isset($_POST['phone_locataires']) && isset($_POST['mail_locataires'])  && isset($_POST['idmaison']) && isset($_POST['date_entree'])){
				if(
					$_POST['nom_locataires']!=="" 
					&& $_POST['prenom_locataires']!==""
					&& $_POST['phone_locataires']!==""
					&& $_POST['mail_locataires']!==""
					&& $_POST['idmaison']!==""
					&& $_POST['date_entree']!==""
				){
					//var_dump($_POST);
					$nom_locataires 	= strtoupper($_POST['nom_locataires']); 	
					$prenom_locataires 	= strtoupper($_POST['prenom_locataires']);	
					$phone_locataires 	= $_POST['phone_locataires'];
					$mail_locataires 	= $_POST['mail_locataires'];
					$idmaison 			= $_POST['idmaison'];	
					$first_date 		= $_POST['date_entree'];
					$last_date 			= ""; // date de demenagement locataire: ajout par modification le jour de rupture contrat de bail
					//generation de suite de caracteres
					$length=9;
					$Pass_by_mail= substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
					//Hashage
					$options = ['cost' => 12,];
					$mdpass_locataires= password_hash( $Pass_by_mail, PASSWORD_BCRYPT, $options);
					//var_dump($Pass_by_mail);
					//var_dump($mdpass_locataires);

					$length=5;
					$codes=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
					$rul="locataire-".date('Ymd').$codes;	
					$ok=$this->locataires->create([
						'iduniq_locataires'	=>	$rul,
						'nom_locataires'	=> 	trim(htmlentities($nom_locataires)),
						'prenom_locataires'	=> 	trim(htmlentities($prenom_locataires)),
						'phone_locataires'	=>	trim(htmlentities($phone_locataires)),
						'mail_locataires'	=>	trim(htmlentities($mail_locataires)),
						'mdpass_locataires'	=>	trim(htmlentities($mdpass_locataires)),
						'ckl'	=> 	$Pass_by_mail
						//'datefin'		=>	date('Y-m-d', strtotime($datedefin. '+1 DAY'))		
					]);

					$locbail=$this->locat_bails->create([
						'locataire_iduniq'	=>	$rul,
						'first_date'		=>	trim(htmlentities($first_date )),
						'maison_iduniq'		=>	trim(htmlentities($idmaison)),
						'statut_locataire'	=>	1,
						'bailleur_iduniq'	=> 	$clebailleur		
					]);
					$idpatrimoine=$this->patrimoines->findById($idmaison)->idpatrimoines;
					//var_dump($idpatrimoine);
					$Yes=$this->patrimoines->update($idpatrimoine, [
						'statut'	=> 1		
					]);
					/* ENVOI D'UN MAIL DE CONFIRMATION*/
					$maildest=$mail_locataires;
					$nomdest=$nom_locataires;
					$objet="***CREATION de compte***";
					$contenuMsg="Bonjour &nbsp;". $nomdest.",<br>  votre bail avec Mme/M.".$nombailleur." a été validé avec succès. <b> Mail:</b> ".$maildest. " || Mot de passe: " .$Pass_by_mail." <br/> Ce sont; ci-dessus, vos accès de connexion à votre compte sur <b>Loyer Plus</b>. 
					<br><br>NB: Il est fortement conseillé de garder confidentiel son mot de passe.";
					$contenuMsg=str_replace("\n.", "\n..", $contenuMsg);
					$from_name="Loyer Plus";

					$from_mail="noreply@simplonien-da.net";//Not reply;
					$encoding = "utf-8";
						 // Mail header
					$header = 'Content-type: text/html; charset='.$encoding."\r\n";
					$header .= 'From: '.$from_name.'<'.$from_mail.'>'."\r\n";
					$header .= 'To:'.$maildest."\n";
					$header .= 'MIME-Version: 1.0'."\r\n";
					$header .= 'Content-Transfer-Encoding: 8bit'."\r\n";
					$header .= 'Date:'.date("r (T)")." \r\n";
					$tomail=mail($maildest, $objet, $contenuMsg, $header);
										
					if($ok && $Yes && $locbail && $tomail){
						$successMSG="Locataire enregistr&eacute; avec succès !";
						header('refresh:3,?p=bailleur.listLocataire');
						$this->render("annonces.rdvvalid", compact('successMSG'));
						exit;
					}else{
						$errMSG="OOOP une erreur est survenue. Veuillez essayer plus tard !"; 
					}
					if($ok && $Yes && $locbail){
						$successMSG="Locataire enregistr&eacute;!";

						
						####
						
						header('refresh:2,?p=bailleur.listLocataire');
					}else{
						$errMSG="Echec enregistrement.";
					}
						
				//}else{ $errMSG="Texte des détails sur l'événement doit contenir 1400 caractères maximum !";}
				}else{$errMSG= "Au moins un champ est mal rempli !";}
			}else{die("NOTHING");}		
		}

		$lerecruteur=$this->bailleurs->findById($_SESSION['bailleur_id'])->iduniq_bailleurs;
		//var_dump($lerecruteur);
		$ville=$this->villes->all();
		$portevidee=$this->patrimoines->controlePorteLibre();
		//var_dump($portevidee);

		if(isset($errMSG)){
			$this->render("bailleur.ajouter_locataire", compact('portevidee', 'ville','lerecruteur', 'errMSG'));
		}elseif(isset($successMSG)){
			$this->render("bailleur.ajouter_locataire", compact('portevidee', 'ville','lerecruteur', 'successMSG'));
		}else{
			$this->render("bailleur.ajouter_locataire", compact('portevidee', 'ville','lerecruteur'));
		}
		
	}
	public function oldlocataire(){	

		$this->islogged();

		$clebailleur=$this->bailleurs->findById($_SESSION['bailleur_id'])->iduniq_bailleurs;
		$nombailleur=$this->bailleurs->findById($_SESSION['bailleur_id'])->nom_bailleurs;

		if (isset($_POST["oldlocataire"])) {
			//var_dump($_POST);
			if(isset($_POST['rul_locataire']) && isset($_POST['idmaison']) && isset($_POST['date_entree'])){
				if(
					$_POST['rul_locataire']!==""
					&& $_POST['idmaison']!==""
					&& $_POST['date_entree']!==""
				){
					//var_dump($_POST);
					$RUL_locataires 	= $_POST['rul_locataire'];
					$idmaison 			= $_POST['idmaison'];	
					$first_date 		= $_POST['date_entree'];
					$last_date 			= ""; // date de demenagement locataire: ajout par modification le jour de rupture contrat de bail
					//generation de suite de caracteres
					$ok=$this->locat_bails->create([
						'locataire_iduniq'	=>	$RUL_locataires,
						'first_date'		=>	trim(htmlentities($first_date )),
						'maison_iduniq'		=>	trim(htmlentities($idmaison)),
						'statut_locataire'	=>	1,
						'bailleur_iduniq'	=> 	$clebailleur		
					]);
					$idpatrimoine=$this->patrimoines->findByIduniq($idmaison)->idpatrimoines;
					//var_dump($idpatrimoine);
					$Yes=$this->patrimoines->update($idpatrimoine, [
						'statut'	=> 1		
					]);
					/* ENVOI D'UN MAIL DE CONFIRMATION*/
					$maildest=$mail_locataires;
					$nomdest=$nom_locataires;
					$objet="***CREATION de compte***";
					$contenuMsg="Bonjour &nbsp;". $nomdest.",<br>  votre bail avec Mme/M.".$nombailleur." a été validé avec succès. <b> Mail:</b> ".$maildest. " || Mot de passe: *******(le même que vous utilisez habituellement sur <b>Loyer Plus</b>). 
					<br><br>NB: Il est fortement conseillé de garder confidentiel son mot de passe.";
					$contenuMsg=str_replace("\n.", "\n..", $contenuMsg);
					$from_name="Loyer Plus";

					$from_mail="noreply@simplonien-da.net";//Not reply;
					$encoding = "utf-8";
						 // Mail header
					$header = 'Content-type: text/html; charset='.$encoding."\r\n";
					$header .= 'From: '.$from_name.'<'.$from_mail.'>'."\r\n";
					$header .= 'To:'.$maildest."\n";
					$header .= 'MIME-Version: 1.0'."\r\n";
					$header .= 'Content-Transfer-Encoding: 8bit'."\r\n";
					$header .= 'Date:'.date("r (T)")." \r\n";
					$tomail=mail($maildest, $objet, $contenuMsg, $header);
										
					if($ok && $Yes && $tomail){
						$successMSG="Locataire enregistr&eacute; avec succès !";
						header('refresh:3,?p=bailleur.listLocataire');
						$this->render("annonces.rdvvalid", compact('successMSG'));
						exit;
					}else{
						$errMSG="OOOP une erreur est survenue. Veuillez essayer plus tard !"; 
					}
				}else{$errMSG= "Au moins un champ est mal rempli !";}
			}else{die("NOTHING");}		
		}

		$lerecruteur=$this->bailleurs->findById($_SESSION['bailleur_id'])->iduniq_bailleurs;
		//var_dump($lerecruteur);
		$ville=$this->villes->all();
		$portevidee=$this->patrimoines->controlePorteLibre();
		//var_dump($portevidee);

		if(isset($errMSG)){
			$this->render("bailleur.ajouter_locataire", compact('portevidee', 'ville','lerecruteur', 'errMSG'));
		}elseif(isset($successMSG)){
			$this->render("bailleur.ajouter_oldlocataire", compact('portevidee', 'ville','lerecruteur', 'successMSG'));
		}else{
			$this->render("bailleur.ajouter_oldlocataire", compact('portevidee', 'ville','lerecruteur'));
		}
		
	}

	public function readMoreMaison(){
		$this->islogged();
		if(isset($_GET['suitable'])) 
			$idread=$_GET['suitable'];
		$oneInfo=$this->bailleurs->lectureOneMaison($idread);		
		$lerecruteur=$this->bailleurs->findById($_SESSION['bailleur_id']);
		$this->render("bailleur.liremaison", compact('oneInfo', 'lerecruteur'));
	}

	public function readMoreLocataire(){
		$this->islogged();
		if(isset($_GET['suitable'])) 
			$idread=$_GET['suitable'];
		$oneInfo=$this->bailleurs->lectureOneLocataire($idread);		
		$lerecruteur=$this->bailleurs->findById($_SESSION['bailleur_id']);
		$this->render("bailleur.lirelocataire", compact('oneInfo', 'lerecruteur'));
	}

	public function majMaison(){

		/* MIs a jour des loyers et autres parametre lies a la maison*/
		$this->islogged();
		if (isset($_POST["editmaison"])){
			if(isset($_GET['suitable'])){
				$idpat=$_GET['suitable'];
				$iduniqbail=$this->bailleurs->findById($_SESSION['bailleur_id'])->iduniq_bailleurs;
				$lepatrimoine=$this->patrimoines->laMaison($iduniqbail,$idpat);
				$idpatr=$lepatrimoine->idpatrimoines;

				if(					
					$_POST["reference_porte"]!=="" 
					&& $_POST["loyer"]!==""
				){
					$a=$this->patrimoines->update($idpatr,[
						'porte_num_pat'	=> 	trim(htmlentities($_POST["reference_porte"])),
						'loyer'	=>	trim(htmlentities($_POST["loyer"]))
						]);
					if($a){
							header('refresh:2,index.php?p=bailleur.compteconnected');
							$successMSG="Mise &agrave; jour avec succ&egrave; !";
					}else{ 
						$errMSG="La mise &agrave; jour a échoué !";}
					//}else{ $errMSG="Texte des détails sur l'événement doit contenir 1400 caractères maximum !";}
				}else{
					$errMSG="Probablement un ou des champs vides !";
				}
			}else{ 
				$errMSG="L'objet n'existe probablement pas !";
				header('refresh:2,index.php?p=bailleur.compteconnected');
			}
		}

		$lebailleur=$this->bailleurs->findById($_SESSION['bailleur_id']);
		$iduniqbail=$this->bailleurs->findById($_SESSION['bailleur_id'])->iduniq_bailleurs;
		
		if(isset($_GET['suitable'])) 
			$idpat=$_GET['suitable'];
			$oneInfo=$this->patrimoines->laMaison($iduniqbail,$idpat);
		if(isset($errMSG)){
			$this->render("bailleur.modifmaison", compact('oneInfo', 'lebailleur', 'errMSG'));
		}elseif (isset($warningMSG)) {
			$this->render("bailleur.modifmaison", compact('oneInfo', 'lebailleur', 'warningMSG'));
		}elseif(isset($successMSG)){
			$this->render("bailleur.modifmaison", compact('oneInfo', 'lebailleur', 'successMSG'));
		}else{	$this->render("bailleur.modifmaison", compact('oneInfo', 'lebailleur'));
		}
		
	}	

	public function majLocataire(){
		$this->islogged();
		if (isset($_POST["editlocataire"])){
			if(isset($_GET['suitable']) && isset($_POST['lastdate'])){
				$idpat=$_GET['suitable']; 
				$lastdate = $_POST['lastdate'];
				$lepost=$this->bailleurs->majlOffre($idpat);
				$idlocatbail=$lepost->idlocat_bails;
				$idpatrimoine=$lepost->idpatrimoines;

				if(					
					$_POST['lastdate']!=="" 
				){
					$datedefin=trim(htmlentities($_POST["lastdate"]));
					$a=$this->locat_bails->update($idlocatbail,[
						'statut_locataire'	=> 	0,
						'last_date'	=>	$datedefin
						]);
					$b=$this->patrimoines->update($idpatrimoine,[
						'statut'	=> 	0
						]);
					
					if($a && $b){
							header('refresh:2,index.php?p=bailleur.listLocataire');
							$successMSG="Mise &agrave; jour avec succ&egrave; !";
					}else{ 
						$errMSG="La mise &agrave; jour a échoué !";}
				}else{
					$errMSG="Probablement un ou des champs vides !";
				}
			}else{ 
				$errMSG="L'objet n'existe probablement pas !";
				header('refresh:2,index.php?p=bailleur.listLocataire');
			}
		}

		if(isset($_GET['suitable'])) 
			$idpat=$_GET['suitable'];
			$oneInfo=$this->bailleurs->majlOffre($idpat);
		if(isset($errMSG)){
			$this->render("bailleur.fin_bail", compact('oneInfo', 'errMSG'));
		}elseif (isset($warningMSG)) {
			$this->render("bailleur.fin_bail", compact('oneInfo', 'warningMSG'));
		}elseif(isset($successMSG)){
			$this->render("bailleur.fin_bail", compact('oneInfo', 'successMSG'));
		}else{
			$this->render("bailleur.fin_bail", compact('oneInfo'));
		}
		
	}

/*=============AFFICHAGE DES OFFRES EMPLOI/STAGE==========*/

	public function listMaison(){
		$this->islogged();
		$idbailleur=$this->bailleurs->findById($_SESSION['bailleur_id'])->iduniq_bailleurs;
		//var_dump($idbailleur);
		$toutesmaisons=$this->bailleurs->mesMaisons($idbailleur);
		//var_dump($toutesmaisons);
		if (isset($_GET['pageno'])) {
	        $pageno = $_GET['pageno'];
	    } else {
	        $pageno = 1;
	    }
	    $no_of_records_per_page = 12;
	    $offset = ($pageno-1) * $no_of_records_per_page;
	    $total_pages = ceil(count($toutesmaisons) / $no_of_records_per_page);
		$maisonListe=$this->bailleurs->paginateValide($idbailleur,$offset,$no_of_records_per_page);
		//var_dump($maisonListe);
		if(empty($maisonListe)){
			$warningMSG="Vous n'avez aucune maison Ajoutée pour l'instant !";
		}

		$lebailleur=$this->bailleurs->findById($_SESSION['bailleur_id']);
		//var_dump($lebailleur);

		if(isset($warningMSG)){
			$this->render("bailleur.maisons", compact('warningMSG', 'lebailleur'));
		}else{
			$this->render("bailleur.maisons", compact('pageno', 'total_pages', 'maisonListe', 'lebailleur'));
		}
	}
	public function maisonLibres(){
		$this->islogged();
		$idbailleur=$this->bailleurs->findById($_SESSION['bailleur_id'])->iduniq_bailleurs;
		//var_dump($idbailleur);
		$toutesmaisons=$this->bailleurs->mesMaisonsLibres($idbailleur);
		//var_dump($toutesmaisons);
		if (isset($_GET['pageno'])) {
	        $pageno = $_GET['pageno'];
	    } else {
	        $pageno = 1;
	    }
	    $no_of_records_per_page = 12;
	    $offset = ($pageno-1) * $no_of_records_per_page;
	    $total_pages = ceil(count($toutesmaisons) / $no_of_records_per_page);
		$maisonListe=$this->bailleurs->paginateLibres($idbailleur,$offset,$no_of_records_per_page);
		//var_dump($maisonListe);
		if(empty($maisonListe)){
			$warningMSG="Toutes vos maisons sont occupées actuellement !";
		}

		$lebailleur=$this->bailleurs->findById($_SESSION['bailleur_id']);
		//var_dump($lebailleur);

		if(isset($warningMSG)){
			$this->render("bailleur.maisons_libres", compact('warningMSG', 'lebailleur'));
		}else{
			$this->render("bailleur.maisons_libres", compact('pageno', 'total_pages', 'maisonListe', 'lebailleur'));
		}
	}
	public function maisonOccupees(){
		$this->islogged();
		$idbailleur=$this->bailleurs->findById($_SESSION['bailleur_id'])->iduniq_bailleurs;
		//var_dump($idbailleur);
		$toutesmaisons=$this->bailleurs->mesMaisonsOqp($idbailleur);
		//var_dump($toutesmaisons);
		if (isset($_GET['pageno'])) {
	        $pageno = $_GET['pageno'];
	    } else {
	        $pageno = 1;
	    }
	    $no_of_records_per_page = 12;
	    $offset = ($pageno-1) * $no_of_records_per_page;
	    $total_pages = ceil(count($toutesmaisons) / $no_of_records_per_page);
		$maisonListe=$this->bailleurs->paginateOqp($idbailleur,$offset,$no_of_records_per_page);
		//var_dump($maisonListe);
		if(empty($maisonListe)){
			$warningMSG="Vous n'avez aucune maison dans cette liste pour l'instant !";
		}

		$lebailleur=$this->bailleurs->findById($_SESSION['bailleur_id']);
		//var_dump($lebailleur);

		if(isset($warningMSG)){
			$this->render("bailleur.maison_occupees", compact('warningMSG', 'lebailleur'));
		}else{
			$this->render("bailleur.maison_occupees", compact('pageno', 'total_pages', 'maisonListe', 'lebailleur'));
		}
	}


	public function listLocataire(){
		$this->islogged();
		$idbailleur=$this->bailleurs->findById($_SESSION['bailleur_id'])->iduniq_bailleurs;
		//var_dump($idbailleur);
		$toulocataires=$this->bailleurs->mesLocataires($idbailleur);
		//var_dump($toulocataires);
		if (isset($_GET['pageno'])) {
	        $pageno = $_GET['pageno'];
	    } else {
	        $pageno = 1;
	    }
	    $no_of_records_per_page = 12;
	    $offset = ($pageno-1) * $no_of_records_per_page;
	    $total_pages = ceil(count($toulocataires) / $no_of_records_per_page);
		$locataireListe=$this->bailleurs->paginatelocataire($idbailleur,$offset,$no_of_records_per_page);
		//var_dump($locataireListe);
		if(empty($locataireListe)){
			$warningMSG="Vous n'avez aucun locataire Ajouté pour l'instant !";
		}

		$lebailleur=$this->bailleurs->findById($_SESSION['bailleur_id']);
		//var_dump($lebailleur);

		if(isset($warningMSG)){
			$this->render("bailleur.locataires", compact('warningMSG', 'lebailleur'));
		}else{
			$this->render("bailleur.locataires", compact('pageno', 'total_pages', 'locataireListe', 'lebailleur'));
		}
	}


/* POINT FINANCIERS === BILAN D'UN LOCATAIRE ==== BILAN DE TOUS LES LOCATAIRE
 === BILAN D'UNE MAISON ()//

  BILAN DE TOUTES LES MAISONS*/


	public function finance(){
		$this->islogged();
		$idbailleur=$this->bailleurs->findById($_SESSION['bailleur_id'])->iduniq_bailleurs;
		//var_dump($idbailleur);
		$toulocataires=$this->bailleurs->mesLocataires($idbailleur);
		//var_dump($toulocataires);
		if (isset($_GET['pageno'])) {
	        $pageno = $_GET['pageno'];
	    } else {
	        $pageno = 1;
	    }
	    $no_of_records_per_page = 12;
	    $offset = ($pageno-1) * $no_of_records_per_page;
	    $total_pages = ceil(count($toulocataires) / $no_of_records_per_page);
		$locataireListe=$this->bailleurs->paginatelocataire($idbailleur,$offset,$no_of_records_per_page);
		//var_dump($locataireListe);
		if(empty($locataireListe)){
			$warningMSG="Vous n'avez aucun locataire Ajouté pour l'instant !";
		}

		$lebailleur=$this->bailleurs->findById($_SESSION['bailleur_id']);
		//var_dump($lebailleur);

		if(isset($warningMSG)){
			$this->render("bailleur.finances", compact('warningMSG', 'lebailleur'));
		}else{
			$this->render("bailleur.finances", compact('pageno', 'total_pages', 'locataireListe', 'lebailleur'));
		}
	}

/*=============FIN===CREER ET GERER DES ==========*/


}




