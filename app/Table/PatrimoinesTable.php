<?php 
/**
* php:Alain KIKOUN 
**/
 ?>
<?php  
namespace App\Table;

use Core\Table\Table;

class PatrimoinesTable extends Table{

	protected $table="patrimoines";





	public function controlePorteLibre(){
		return $this->tableQuery("SELECT * FROM patrimoines WHERE patrimoines.statut=0");
	}

	public function laMaison($bailleur, $patrimoine){
		 $a=$this->tableQuery("SELECT * FROM patrimoines INNER JOIN bailleurs ON patrimoines.bailleur_id=bailleurs.iduniq_bailleurs INNER JOIN villes ON  patrimoines.ville_id=villes.idvilles WHERE patrimoines.bailleur_id=? AND patrimoines.iduniq_pat=? ", [$bailleur, $patrimoine], true); 
		 return $a;
	}

}