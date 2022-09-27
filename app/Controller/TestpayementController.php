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
		$this->loadModel('identites');
		$this->loadModel('villes');
		$this->loadModel('bailleurs');
		$this->loadModel('patrimoines');
		$this->loadModel('locataires');
		$this->loadModel('locat_bails');
		$this->loadModel('payements');
	}

	public function index(){
		if(isset($_POST['pay-btn'])){
			if(isset($_POST['numero-paymt'], $_POST['lebailleur'], $_POST['lelocataire'], $_POST['lamaison'])){
				$telephone= $_POST['numero-paymt'];
				$ref_paymt=date("Ym")." loca ".rand();
				$ref_locataire= $_POST['lelocataire'];
				$ref_bailleur= $_POST['lebailleur'];
				$ref_maison= $_POST['lamaison'];
				$length=5;
				$lebail=$this->payements->monbail($ref_locataire,$ref_maison,$ref_bailleur);
				$loyerC=$lebail->loyer;
				$loyerP=$loyerC;
				$codes=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
				$iduni_paymt="paymt-".date("mY")."-".$codes;
				if(!empty($telephone) && !empty($ref_locataire) && !empty($ref_bailleur) && !empty($ref_maison)){
					$payer=$this->payements->create([
						"iduniq_payement" =>	$iduni_paymt,
						"bailleurs"			=>	$ref_bailleur,
						"idmaison"			=>	$ref_maison,
						"locataire"			=>	$ref_locataire,
						"loyer_courant" 	=>	$loyerC,
						"montant_paye" 	=>	$loyerP,
						"phone_payement"	=>	$telephone,
						"date_payement"	=>	date("Y-m-d H:i:s"),
						"id_transaction"	=>	$ref_paymt,
						"payer_via"			=>	"MTN MOMO",
						"statut_transact"	=>	"Accepted"
					]);
					if($payer){
						$successMSG= "Le payement de votre Loyer a bien été effectué. Merci d'avoir utilisé <b>LOYER PLUS </b> et <i>MTN MOMO</i>";
					}else{$errMSG="<b>Echec Transaction. <br/> Informations non parvenues à la base de données.</b>";}
				}else{
	           $errMSG="Certaines données manquent pour conclure la transaction! <b>Problème technique.</b>";
	        }
			}else{
	           $errMSG="ERREUR TRANSACTION";
	        }
		}
		if(isset($_GET['bail'], $_GET['suitable'], $_GET['home'])){
			$bailleur=$_GET['bail'];
			$maison=$_GET['home'];
			$locataire=$_GET['suitable'];
			$onebail=$this->payements->monbail($locataire,$maison,$bailleur);
			$loyerH=$onebail->loyer;
			$loyerDu=$loyerH;
		}
		if(isset($errMSG)){
			$this->render("payements.index", compact('errMSG', 'bailleur', 'maison', 'locataire', 'loyerH', 'loyerDu'));
		}elseif(isset($successMSG)){
			$this->render("payements.index", compact('successMSG', 'bailleur', 'maison', 'locataire', 'loyerH', 'loyerDu'));
		}else{
			$this->render("payements.index",compact('bailleur', 'maison', 'locataire', 'loyerH', 'loyerDu'));
		}
		
	}

}
