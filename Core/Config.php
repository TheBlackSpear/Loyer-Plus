<?php 
namespace Core;

class Config{

	private static $instance;
	private $configs=[];
	
	public function __construct($fileconfig){
		$this->configs= require($fileconfig);/*'../config/config.php'*/
		
	}
	
	//methode appelee dans App a la racine
	public static function configInstance($fileconfig){
		if(self::$instance===null)
		{
			self::$instance= new Config($fileconfig);
		}
			return self::$instance;
	}

	public function get($cleParam){
		if(isset($this->configs))
		{	$valeur=$this->configs[$cleParam];
			return $valeur;
		}else return null;
		
		
	}
}
