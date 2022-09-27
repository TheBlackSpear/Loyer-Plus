<?php 
/**
* Author:Alain KIKOUN
**/
 ?>
<?php 
namespace App\Controller;
use Core\Config;


class LoyerplusController extends AppController{
	

	public function __construct(){
		parent::__construct();

	}


	public function index(){	
		if(isset($_SESSION['bailleur_id'])){
			header('Location:?p=bailleur.compteconnected');
		}
		if(isset($_SESSION['locataire_id'])){
			header('Location:?p=locataire.compteconnected');
		}
		$this->render("loyerplushome.home");
	}
	
	public function joinUs(){
		
			$this->render('loyerplushome.contact');
			
	}				
	
}
