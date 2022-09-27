<?php 
namespace App\Controller;
use \App;
use Core\Auth\DBAuth;
use App\Upload\Uplogo;

/**
* Author:Alain KIKOUN 
**/
 
class PayementController extends AppController{
	public function __construct(){
		parent::__construct();
		$this->loadModel('chapchap');
	}

/*prevoir pagination*/
	public function index(){
		$leschapok=$this->chapchap->offreOk();
		//$this->desactivechap();
		//$jobanners=$this->jobanner->openBanners();

		if (isset($_GET['pageno'])) {
	        $pageno = $_GET['pageno'];
	    } else {
	        $pageno = 1;
	    }
	    $nbperpage = 15;
	    $offset = ($pageno-1) * $nbperpage;
	    $total_pages = ceil(count($leschapok) / $nbperpage);
		$chapListe=$this->chapchap->paginatechap($offset,$nbperpage);
		if(empty($chapListe)){
			$warningMSG="Pas d'offres disponibles pour l'instant !";
		}
		if(isset($warningMSG)){
			$this->render("chapchap.index", compact('warningMSG'));
		}else{
			//$this->render("chapchap.index", compact('chapListe', 'pageno', 'total_pages', 'jobanners'));
			$this->render("chapchap.index", compact( 'pageno', 'total_pages', 'chapListe'));

		}
	}


	public function jobchap(){

		if(isset($_POST["chapjob"])) {
			if(
					$_POST["nomchap"]!==""
				&& 	$_POST["phonechap"]!==""
				&& 	$_POST["titrechap"]!==""
				&& 	$_POST["detailchap"]!==""
				&& 	$_POST["question_reponse"]!==""
			){					
				$titrelength=150;
				$contenulength=1300;
				$deuxmois=time() + (56 * 24 * 60 * 60);
				if(strlen($_POST["titrechap"])<$titrelength){
					if(strlen($_POST["detailchap"])<=$contenulength){
						$qrep=strtolower($_POST["question_reponse"]);
						if($qrep==="rouge"){
							$okchap=$this->chapchap->create([
								'titrechap'		=> 	trim(htmlentities($_POST["titrechap"])),
								'contenuchap'	=> 	trim(htmlentities($_POST["detailchap"])),
								'nomchap'		=>	trim(htmlentities($_POST["nomchap"])),
								'phonechap'		=> 	trim(htmlentities($_POST["phonechap"])),
								'added_at'		=> 	date('Y-m-d'),
								'expire_le'		=> 	date('Y-m-d', $deuxmois),
								'vok'			=> 	0,
								'adminok'		=> 	0		
							]);
							if($okchap){
								$successMSG="Offre enregistr&eacute;e.Attente approbation du webmaster !";
								header('refresh:2,?p=chapchap.index');
							}else{
								$errMSG="Echec d'envoi.";}

						}else{ $errMSG="COULEUR DU SANG : Réponse incorrecte !";}

					}else{$errMSG="Contenu d'offre trop long. Veuillez être précis et concis !";}
				}else{$errMSG="Titre d'offre trop long. Veuillez être concis !";}
					
			}else{$errMSG= "Au moins un champ est mal rempli !";}
		}		

		
		if(isset($errMSG)){
			$this->render("chapchap.ajouter_chapchap", compact('errMSG'));
		}elseif(isset($successMSG)){
			$this->render("chapchap.ajouter_chapchap", compact('successMSG'));
		}else{
			$this->render("chapchap.ajouter_chapchap");
		}	
	}

			/*	public function desactivechap(){
					$bilan=$this->chapchap->analysechap();
					if($bilan){ 
						foreach ($bilan as $chapoint) {
							$idpat=$chapoint->orderchapchap;
							//die("Bonjour fin de votre offre!");
							$a=$this->chapchap->update($idpat,[
								'adminok'		=> 	0
							]);
						}
					}
					
				}*/


				/*public function supprimchap(){}
			*/


}




