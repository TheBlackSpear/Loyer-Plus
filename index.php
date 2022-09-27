<?php 
ini_set('display_errors',1);
use Core\Config;
use Core\Database\MysqlDatabase;
use Core\Entity\Entity;

header('Content-type: text/html; charset=utf-8');
//define("ROOT",dirname(__DIR__));
define("ROOT",dirname(__FILE__));
//var_dump(FILE_ROOT);
//var_dump(ROOT);
require ROOT.'/app/App.php';
//require ROOT.'/app/Compteur_visites.php';

App::loadage();

if(isset($_GET['p']) && $_GET['p']!=='' && strlen($_GET['p'])>2)
{ //var_dump($_GET['p']);

	$page=$_GET['p'];
}else{
	$page='loyerplus.index';
}

$page=explode('.', $page);

if(isset($page[0]) && isset($page[1])){
	if(!empty($page[0]) && $page[0]!==null && !empty($page[1]) && $page[1]!==null){

		$notrefichier=ROOT."/app/Controller/".ucfirst($page[0]).'Controller.php';

		if(file_exists($notrefichier)){
			if(is_file($notrefichier)){
				$controller= 'App\Controller\\'. ucfirst($page[0]).'Controller';
				$action=$page[1];
				$controller=new $controller();
				if(method_exists($controller,$action)){
					$controller->$action();
				}else{
					$controller= 'App\Controller\ErrpController';
					$controller= new $controller();
					$action='pagenotfound';	
					$controller->$action();
					exit;
				}
			}else{ 
				$controller= 'App\Controller\ErrpController';
				$controller= new $controller();
				$action='pagenotfound';	
				$controller->$action();
			}
		}else{ 
			$controller= 'App\Controller\ErrpController';
			$controller= new $controller();
			$action='pagenotfound';	
			$controller->$action();
		}	

	}else{
		$controller= 'App\Controller\ErrpController';
		$controller= new $controller();
		$action='pagenotfound';	
		$controller->$action();
	}
}else{
		$controller= 'App\Controller\ErrpController';
		$controller= new $controller();
		$action='pagenotfound';	
		$controller->$action();
}
