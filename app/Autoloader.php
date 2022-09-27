<?php 
/**
* php:Alain KIKOUN
**/
 ?>
<?php 
namespace App;

class Autoloader{

	public static function register(){
		spl_autoload_register(array(__CLASS__,'loader'));
	}

	public static function loader($maclass){
		if(strpos($maclass, __NAMESPACE__.'\\')===0){
			$maclasse=str_replace(__NAMESPACE__.'\\', '', $maclass);
			$maclasse=str_replace('\\', '/', $maclasse);
			require __DIR__.'/'.$maclasse.'.php';
		}
	}
}