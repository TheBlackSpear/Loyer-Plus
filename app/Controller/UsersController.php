<?php 
/**
* Author:Alain KIKOUN
**/
 ?>
<?php 
namespace App\Controller;
use Core\Auth\DBAuth;

class UsersController extends AppController{

	protected $template='info_auth';

	public function login(){
		if(!empty($_POST)){	
			$auth=new DBAuth(\App::getInstanceApp()->getDatabase());
			if($auth->login($_POST['username'], $_POST['password'])){
				$successMSG="Connexion en cours...";
				header('refresh:2,index.php?p=admin.dashboard.index');		
			}else{$errMSG="Identifiant ou Mot de passe erroné!";}
		}
		if(isset($errMSG)){
			$this->render("connexion.login",compact('errMSG'));
		}elseif(isset($successMSG)){
			$this->render("connexion.login",compact( 'successMSG'));
		}else{	$this->render("connexion.login");}
	
	}
	
}