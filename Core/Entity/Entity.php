<?php 
/**
* php:Alain KIKOUN 
**/
 ?>
<?php
namespace Core\Entity;

 class Entity{

 	public function __get($cle){
 		$method='get'.ucfirst($cle);
 		$this->$cle=$this->$method();
 		return $this->$cle;
 	}
 }