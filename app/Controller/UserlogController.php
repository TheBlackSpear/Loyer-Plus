<?php 
/**
* Author:Alain KIKOUN
**/
 ?>
<?php 
namespace App\Controller;
use  Core\HTML\BootstrapForm;
use Core\Auth\DBAuth;

class UserlogController extends AppController{

	protected $template='info_auth';

	public function login(){
		if(!empty($_POST)){	
			$auth=new DBAuth(\App::getInstanceApp()->getDatabase());
			if($auth->login($_POST['username'], $_POST['password'])){
				$successMSG="Connexion en cours...";
				header('refresh:5,index.php?p=admin.dashboard.index');		
			}
			else 
			{$errMSG="Identifiant ou Mot de passe erroné!";}
		}
			$this->render("connexion.login",compact('errMSG', 'successMSG'));
	
	}
	
}