<?php 
/**
* php:Alain KIKOUN /design: Jean-Baptiste KOFFI
**/
 ?>
<?php 
namespace App\Table;

use Core\Table\Table;

class PayementsTable extends Table{
		protected $table="payements";

	
	public function monbail($locataire,$maison,$bailleur){
		$statutl=1;
		$a=$this->tableQuery("SELECT *  FROM bailleurs INNER JOIN locat_bails ON bailleurs.iduniq_bailleurs=locat_bails.bailleur_iduniq INNER JOIN locataires ON locataires.iduniq_locataires=locat_bails.locataire_iduniq INNER JOIN patrimoines ON patrimoines.iduniq_pat=locat_bails.maison_iduniq WHERE  locat_bails.locataire_iduniq=? AND locat_bails.maison_iduniq=? AND locat_bails.bailleur_iduniq=? AND locat_bails.statut_locataire=?", [$locataire, $maison, $bailleur, $statutl], true); 
		 return $a;
	}

	public function partnerDelai(){
		$active=1;
		return $this->tableQuery("SELECT *, DATEDIFF(partner_fin, now()) AS DateDiff  FROM partenaire WHERE actived=?", [$active], false);
	}
}