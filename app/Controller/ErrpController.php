<?php 
/**
* Author:Alain KIKOUN
**/
 ?>
<?php 
namespace App\Controller;
use \App;


class ErrpController extends AppController{

	public function __construct(){
		parent::__construct();
	}


	public function pagenotfound(){

		$errMSG="Page introuvable ! <br/> Page not Found !";
		header('HTTP/1.0 404 Not Found');
		$this->render("annonces.notfound",compact('errMSG'));
	}


}
