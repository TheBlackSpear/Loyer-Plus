<?php 
namespace App\Controller;
use \App;
use Core\Auth\DBAuth;

/**
* Author:Alain KIKOUN 
**/
 
class TestpayementController extends AppController{
	public function __construct(){
		parent::__construct();
		/*$this->loadModel('abidjanzone');
		$this->loadModel('rdv');
		$this->loadModel('cineclient');
		$this->loadModel('cinegiver');*/
		/*$this->loadModel('patrimoines');
		$this->loadModel('zone');
		$this->loadModel('blog');
		$this->loadModel('house');
		$this->loadModel('apropos');*/
	}

	/*public function index(){
		$offredispo=$this->patrimoine->findById($idMaison);
		$this->render("cinehouse.index", compact('errMSG','offredispo', 'mailOfUs', 'smallistOffres', 'shortlist'));
	}*/

	public function index(){
		//$alloffres=$this->patrimoine->touteoffre();
		/*$blogcateg=$this->blog->blogListe();*/
/*
		if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 12;
        $offset = ($pageno-1) * $no_of_records_per_page;
        $total_pages = ceil(count($alloffres) / $no_of_records_per_page);

		$offreListe=$this->patrimoine->paginateoffre($offset,$no_of_records_per_page);		
		$val_zone=$this->zone->zones();*/
		/*$allinfo=$this->apropos->listAboutUs();
		$quinous=$this->apropos->aboutUs();
		$shortlist=$this->blog->blogShortList();*/

		$this->render("payements.index",compact('pageno', 'total_pages', 'offreListe', 'val_zone'));
	}


	public function onecinehouse(){
		/*$mailOfUs=$this->apropos->aboutUs();*/
		if (isset($_GET)) {
			if(isset($_GET['coderef'])){
				$idMaison=$_GET['coderef'];
				if($idMaison){
					$resultat=$this->patrimoine->findById($idMaison);
					if(!$resultat){
					$errMSG="OUUUUUPS MAUVAISE REQUETE !&nbsp; &nbsp; &nbsp;<a href=''>Retour vers Accueil</a>";
					}
				}else{
					$errMSG="OUUUUUPS MAUVAISE REQUETE !&nbsp; &nbsp; &nbsp;<a href=''>Retour vers Accueil</a>";
				}				
				//var_dump($resultat);	
			}
		}	
		if(isset($errMSG)){
			$this->render("cinehouse.oneshow", compact('errMSG','resultat'));
		}else{
			$this->render("cinehouse.oneshow", compact('resultat'));
		}
		
	}

	public function priseRdv(){
		/*Seulemt interesse pas besoin de compte*/
		//if (preg_match('#((00225)|(\\+225)) ([-. ]?[0-9]{2}){4,5}#', $macontact)) {}
		//Table RDV
		if (isset($_POST["rdvok"])) {
			$ok=true;
			if($ok){
				$successMSG="RDV enregistre. Vous serez contact&eacute; pour confirmation !";
				$this->render("cinehouse.rdvvalid", compact('successMSG'));
				exit;
			}else{
				$errMSG="Une erreur est vite arrivee revoir le formulaire de RDV.";
			}
			# code...
		}
		$rdv="";

		if(isset($errMSG)){
			$this->render("cinehouse.rdvform", compact('errMSG','rdv'));
		}else{
			$this->render("cinehouse.rdvform", compact('rdv'));
		}
	}

	public function readMore(){
		$this->islogged();
		if(isset($_GET['suitable'])) 
			$idread=$_GET['suitable'];
		$oneInfo=$this->patrimoine->findById($idread);
		$this->render("cinehouse.lireplus", compact('oneInfo'));
	}

	public function editMore(){
		$this->islogged();
		if (isset($_POST["modifcine"])){
			if($_POST["titreof"]==="" || $_POST["descrof"]==="" || $_POST["prixof"]==="" || $_POST["geolocalisation"]==="" || $_POST["illustrun"]==="" || $_POST["illustrdeux"]==="" || $_POST["illustrois"]===""){
				$errMSG= "Au moins un champ est mal rempli !";
			}else{	
				if(isset($_GET['suitable'])) 
					$idpat=$_GET['suitable'];
					$ordermaj=$this->patrimoine->findByadminactiv($idpat)->orderpatrimoine;		
				$ok=$this->patrimoine->update($ordermaj,[
					'untitre'		=> 	$_POST["titreof"],
					'description'	=>	$_POST["descrof"],
					'cout_jour'		=> $_POST["prixof"],
					'zone_order'	=> $_POST["geolocalisation"],
					'imag1'			=> $_POST["illustrun"],
					'imag2'			=> $_POST["illustrdeux"],
					'imag3'			=> $_POST["illustrois"],
					'cinegiver_order'	=>1,
					'updated_at'	=>date('Y-m-d H:i')

				]);
				if($ok){
					$successMSG="Offre mise &agrave; jour. Attente d'approbation avant publication !";	
					header('refresh:5,index.php?p=cinema.compteconnected');
				}else{
					$errMSG="Echec de la mise &agrave; jour !";
				}
			}
		}
		if(isset($_GET['suitable'])) 
			$idpat=$_GET['suitable'];
		$oneInfo=$this->patrimoine->findByadminactiv($idpat);
		$zonegeo=$this->zone->zones();
		$this->render("cinehouse.modifplus", compact('zonegeo', 'oneInfo', 'errMSG', 'successMSG'));
	}

	/*$_POST["votremail"]
$_POST["ancmdp"]"Ancien mot de passe"
$_POST["nouvmdp"]"Nouveau mot de passe"
$_POST["confnouvmdp"]"Nouveau mot de passe"
$_POST["editmotdepasse"]
$_POST[""]*/
	public function editMdp(){

		$this->islogged();

		/*if(!empty($_POST)){	
			if(isset($_POST["editpasse"])){
				
				$auth=new DBAuth(\App::getInstanceApp()->getDatabase());
				if($auth->login($_POST['username'], $_POST['password'])){
					$successMSG="Connexion en cours...";
					header('refresh:5,index.php?p=cinema.compteconnected');		
				}else{ 
					$errMSG="Identifiant ou Mot de passe erroné!";}
			}
		}*/
		$wsa='';
		$this->render("cinehouse.modifmdp", compact('wsa'));
	}

	public function compteCreate(){
		/*verifier si connecte sinon inscrire*/
		if (isset($_POST["validaform"])){
			if(
				$_POST['nomowner']!=='' 
				&& $_POST['prenomowner']!=='' 
				&&$_POST['emailowner']!==''
				&&$_POST['emailowner']!==''
				&& $_POST['pieceid']!=='' 
				&& $_POST['passowner']!=='' 
				&& $_POST['confpassowner']!=='' 
				&& $_POST['fonctionowner']!==''
				&& $_POST['contacts']!=='' 
				&& $_POST['localisation']!==''
				){ 
					if(isset($_POST["emailowner"])){
						$mail=$_POST["emailowner"];
						$controlmail=$this->cinegiver->isMailExist($mail);
						if($controlmail==false){
							if($_POST['passowner']===$_POST['confpassowner']){
								$donnees=$_POST;
								UploadPdf::controle($donnees); 

								if(isset(UploadPdf::$errFile)){
									$errMSG=UploadPdf::$errFile;
									
								}elseif(isset(UploadPdf::$new_doc)){
									$fichierdoc=UploadPdf::$new_doc;
									$docAjouter=$fichierdoc;
									//var_dump($docAjouter);

									/*$options = ['cost' => 12,];
									$passwd = $_POST['passrec'];*/

									$offreurcreate=$this->cinegiver->create([
										'idcinegiver'		=>	md5(rand()),
										'cinegiver_nom'	=> trim(htmlspecialchars (htmlentities($_POST['nomowner']))),
										'cinegiver_prenom'	=>trim(htmlspecialchars (htmlentities($_POST['prenomowner']))),
										'cinegiver_age'=> $docAjouter,
										'cinegiver_contact'=> trim(htmlspecialchars (htmlentities($_POST['contacts']))),
										'cinegiver_mail'=> trim(htmlspecialchars (htmlentities($_POST['emailowner']))),
										'cinegiver_adresse'=> trim(htmlspecialchars (htmlentities($_POST['localisation']))),
										'cinegiver_passwd'=> trim(htmlspecialchars (htmlentities($_POST['passowner']))),
										/*'cinegiver_passwd'		=> password_hash(
											$passwd,
											PASSWORD_BCRYPT,
											$options
										),*/
										'cinegiver_token'	=>	0,
										'cinegiver_active'	=>	1,
										'dateplus'	=>date("Y-m-d H:i"),
										'datemodif'=>date("Y-m-d H:i")
									]);
									if ($offreurcreate){ 
										$successMSG='Enregistrement terminé!';
										$this->render("cinehouse.rdvvalid", compact('successMSG'));
									}else{
										$errMSG='Echec enregistrement !!!';
										}
								}
							}else{$errMSG="Les mots de passe diffèrent !";}
						}else{ $errMSG="Désolé, ce mail est déjà existant !";}
					}else{ $errMSG="Désolé, aucun mail ajouté !";}
				}else{$errMSG="Au moins un champ est vide. Veuillez remplir à nouveau le formulaire !";}
		}
		$this->render("cinehouse.compteform", compact('errMSG'));
	}

	public function loginFormee(){
		/*if(isset($_GET['id'])) 
			$idread=$_GET['id'];
		$oneInfo=$this->apropos->findById($idread);*/
		$this->render("cinehouse.loginfom", compact());
	}

	public function loginForm(){		
		if(!empty($_POST)){	
			if(isset($_POST["connexionof"])){
				$auth=new DBAuth(\App::getInstanceApp()->getDatabase());
				if($auth->logingiver($_POST['username'], $_POST['password'])){
					$successMSG="Connexion en cours...";
					header('refresh:5,index.php?p=cinema.compteconnected');		
				}else{ 
					$errMSG="Identifiant ou Mot de passe erroné!";}
			}
		}
			$this->render("cinehouse.login",compact('errMSG', 'successMSG'));
	}

	public function compteConnected(){
		$this->islogged();
		$mesdonnees=$this->patrimoine->offreInCompte();

		if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 12;
        $offset = ($pageno-1) * $no_of_records_per_page;
        $total_pages = ceil(count($mesdonnees) / $no_of_records_per_page);
		$mesoffreListe=$this->patrimoine->paginateInCompte($offset,$no_of_records_per_page);
			if(empty($mesoffreListe)){
				$warningMSG="Vous n'avez aucune offre pour l'instant ou Probablement toutes sont publiques !";
			};
		$this->render("cinehouse.compteopen", compact('warningMSG', 'pageno', 'total_pages', 'mesoffreListe'));
	}

	public function islogged(){
		$app=App::getInstanceApp();
		$db= $app->getDatabase();
		
		$auth=new DBAuth($db);

		if(!$auth->givlogged())
		{
			header('Location:index.php?p=cinema.loginForm');
		}
	}

	public function lostPass(){
		if(!empty($_POST)){	
			if(isset($_POST["renewpass"])){
				if(isset($_POST["usermail"])){
					$mail=trim($_POST["usermail"]);
					$okmail=$this->cinegiver->isMailExist($mail);
					
					if($okmail){
						#generer key
						$tokenkey=sha1(rand());
						$idgiver=$okmail->ordercinegiver;
						//var_dump($okmail); var_dump($idgiver);

						$replylink="http://www.location.ci/?p=cinema.verifsuitk&listr=".$tokenkey."&avis=0ds&frag=yqo43FgJa27";

						# Ajout key base de données						
						$tobd=$this->cinegiver->update($idgiver,[
							'cinegiver_token'			=>	$tokenkey,
							'datemodif' 	=>	date('Y-m-d H:i')
						]);
						//var_dump($tobd);

						#envoi de mail
						$maildest=$cool->cinegiver_mail;
						$nomdest=$cool->cinegiver_nom;
						$objet="Génération Nouveau Mot de Passe";
						$contenuMsg="Bonjour &nbsp;". $nomdest.",<br> Veuillez cliquer sur le lien suivant pour générer un nouveau mot de passe  : ".$replylink. "<br><br>NB: Il est fortement conseillé de garder confidentiel son mot de passe. Aussi, le changer périodiquement est nécessaire !<br> <br> <b></i>location.ci</i>, Logez sûrement !</b>";
						$contenuMsg=str_replace("\n.", "\n..", $contenuMsg);
						$from_name="location.ci";
						//$from_mail="info@santepros.ci";
						$from_mail="pas_repondre@location.ci";//Not reply;
						$encoding = "utf-8";
							 // Mail header
						$header = 'Content-type: text/html; charset='.$encoding."\r\n";
						$header .= 'From: '.$from_name.'<'.$from_mail.'>'."\r\n";
						$header .= 'Reply-To:'.$maildest."\n";
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
		}
		$this->render("cinehouse.lostpasstpl", compact('errMSG', 'successMSG'));
	}

	public function verifsuitk(){
		if(isset($_GET["listr"])){	
			if($_GET["listr"]!==""){
				$cletoken=$_GET["listr"];
				$iskey=$this->cinegiver->keyExist($cletoken);				
				if($iskey){
					if(!empty($_POST)){
						if(isset($_POST["editnewpass"])){
							if(trim($_POST["newpassword"])!=="" && trim($_POST["confpassword"])!==""){
								$nPass=trim($_POST["newpassword"]);
								$cPass=trim($_POST["confpassword"]);
								if($nPass===$cPass){
									$options = ['cost' => 12,];
									$npassHide = $nPass;
									$newPass = password_hash(
										$npassHide,
										PASSWORD_BCRYPT,
										$options
									);
									$idgivers=$iskey->ordercinegiver;
									#Update mot de passe en base de données
									$maj=$this->cinegiver->update($idgivers,[
									"cinegiver_passwd"=>$newPass,
									"datemodif"=>date('Y-m-d H:i')
									]);									
									#envoi de mail
									$maildest=$iskey->email_recruteur;
									$nomdest=$iskey->nom_recruteur;
									$objet="Votre Nouveau Mot de Passe";
									$contenuMsg="Bonjour &nbsp;". $nomdest.",<br> Vous avez réinitialisé votre nouveau mot de passe avec succès. <br> NB: il est fortement conseillé de garder confidentiel ce mot de passe. Aussi, le changer périodiquement est nécessaire !<br> <br> <b></i>location.ci</i>, Trouvez votre emploi chez nous !</b>";
									$contenuMsg=str_replace("\n.", "\n..", $contenuMsg);
									$from_name="location.ci";
									$from_mail="pas_repondre@location.ci";
									$encoding = "utf-8";
									 // Mail header
								    $header = 'Content-type: text/html; charset='.$encoding."\r\n";
								    $header .= 'From: '.$from_name.'<'.$from_mail.'>'."\r\n";
								    $header .= 'Reply-To:'.$maildest."\n";
								    $header .= 'MIME-Version: 1.0'."\r\n";
								    $header .= 'Content-Transfer-Encoding: 8bit'."\r\n";
								    $header .= 'Date:'.date("r (T)")." \r\n";
							    	
							    	  // Send mail
								    $envoiMsg=mail($maildest, $objet, $contenuMsg, $header);
								//if($envoiMsg && $maj){$successMSG="Votre nouveau mot de passe a été généré et envoyé par mail !";}else{$errMSG="Echec de génération du nouveau mot de passe !"; }
								    if($maj && $envoiMsg){
								    	$tokentoZero=$this->cinegiver->update($idgivers,[
									"cinegiver_token"=>0,
									"datemodif"=>date('Y-m-d H:i')
									]);
								    	$successMSG="Votre nouveau mot de passe a été généré !";
								    }

									}else{ $errMSG="Nouveaux Mots de Passe différents !";}
								
							}else{ $errMSG="Au moins un champ est vide !";}
						}
						#
					}
				}else{
					$errMSG="OOOP, Ce lien a expiré <br> veuillez en générer un nouveau !";
					header('refresh:5,?p=cinema.lostPass');
				}
			}
		}$this->render("cinehouse.newpass", compact('errMSG', 'successMSG'));
 
	}

	public function addMaison(){
        //var_dump($_POST);

		$this->islogged();

		if (isset($_POST["offrecine"])) {
			if($_POST["titreof"]==="" || $_POST["descrof"]==="" || $_POST["prixof"]==="" || $_POST["geolocalisation"]==="" || $_POST["illustrun"]==="" || $_POST["illustrdeux"]==="" || $_POST["illustrois"]===""){
				$errMSG= "Au moins un champ est mal rempli !";
			}else{
				$length=5;
				$codes=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);			
				$ok=$this->patrimoine->create([
					'idpatrimoine'	=>	"PAT-".date('YmdHi').$codes,
					'untitre'		=> 	$_POST["titreof"],
					'description'	=>	$_POST["descrof"],
					'cout_jour'		=> $_POST["prixof"],
					'zone_order'	=> $_POST["geolocalisation"],
					'imag1'			=> $_POST["illustrun"],
					'imag2'			=> $_POST["illustrdeux"],
					'imag3'			=> $_POST["illustrois"],
					'cinegiver_order'	=>1,
					'vueonline'		=>0,
					'vueadmin'		=>0,
					'added_at'		=>date('Y-m-d H:i'),
					'updated_at'	=>date('Y-m-d H:i')

				]);
				if($ok){
					$successMSG="Offre enregistr&eacute;e. Attente d'approbation avant publication !";
					$this->render("cinehouse.rdvvalid", compact('successMSG'));
				}else{
					$errMSG="Echec enregistrement.";
				}
			}
		}$zonegeo=$this->zone->zones();
		$this->render("cinehouse.ajoutmaison", compact('zonegeo', 'errMSG'));
	}

	

}
