<?php 
/**
* Author:Alain KIKOUN
**/
 ?>
<?php  
namespace App\Table;
use Core\Table\Table;

class LocatairesTable extends Table{

	protected $table="locataires";
	
public function isMailExist($mail){
		return $this->tableQuery("SELECT idbailleurs, nom_bailleurs , mail_bailleurs  FROM bailleurs WHERE mail_bailleurs=?",[$mail],true);
	}
	
	public function keyExist($cletoken){
		return $this->tableQuery("SELECT * FROM bailleurs WHERE bailleur_token=?",[$cletoken],true);
	}

	public function getById($id){
		return $this->tableQuery("SELECT * FROM bailleurs 
			 WHERE  idbailleurs=?",["$id"], true);		
	}
/*Maisons*/

	public function mesMaisons($bailleur){/* INNER JOIN locataires ON  patrimoines.iduniq_pat=locataires.maison_iduniq*/
		$active=1;
		 $a=$this->tableQuery("SELECT *  FROM patrimoines INNER JOIN bailleurs ON patrimoines.bailleur_id=bailleurs.iduniq_bailleurs INNER JOIN villes ON  patrimoines.ville_id=villes.idvilles INNER JOIN locataires ON locataires.iduniq_locataires=locat_bails.locataire_iduniq INNER JOIN locat_bails ON  patrimoines.iduniq_pat=locat_bails.maison_iduniq WHERE  patrimoines.bailleur_id=? ", [$bailleur], false); 
		 return $a;
	}

	public function paginateValide($idbailleur, $offset, $nbperpage){
		return $this->tableQuery("SELECT * FROM patrimoines INNER JOIN bailleurs ON patrimoines.bailleur_id=bailleurs.iduniq_bailleurs INNER JOIN villes ON  patrimoines.ville_id=villes.idvilles INNER JOIN locataires ON locataires.iduniq_locataires=locat_bails.locataire_iduniq INNER JOIN locat_bails ON  patrimoines.iduniq_pat=locat_bails.maison_iduniq WHERE patrimoines.bailleur_id=? ORDER BY idpatrimoines DESC  LIMIT $offset, $nbperpage", [$idbailleur ], false);
	}

/*Locataire*/

	public function mesbailleurs($locataire){
		$statutl=1;
		$a=$this->tableQuery("SELECT *  FROM bailleurs INNER JOIN locat_bails ON bailleurs.iduniq_bailleurs=locat_bails.bailleur_iduniq INNER JOIN locataires ON locataires.iduniq_locataires=locat_bails.locataire_iduniq INNER JOIN patrimoines ON patrimoines.iduniq_pat=locat_bails.maison_iduniq WHERE  locat_bails.locataire_iduniq=? AND locat_bails.statut_locataire=? ", [$locataire, $statutl], false); 
		 return $a;
	}

	public function paginatelocataire($idlocataire, $offset, $nbperpage){
		$statutl=1;
		return $this->tableQuery("SELECT *  FROM bailleurs INNER JOIN locat_bails ON bailleurs.iduniq_bailleurs=locat_bails.bailleur_iduniq INNER JOIN locataires ON locataires.iduniq_locataires=locat_bails.locataire_iduniq INNER JOIN patrimoines ON patrimoines.iduniq_pat=locat_bails.maison_iduniq WHERE locat_bails.locataire_iduniq=? AND locat_bails.statut_locataire=? ORDER BY idbailleurs DESC  LIMIT $offset, $nbperpage", [$idlocataire , $statutl], false);
	}

	/*offres invalides*/
	
	public function offreInvalide($recruteur){
		 return $this->tableQuery("SELECT *, DATE_FORMAT(joboffre.publier_le, '%d/%m/%Y') AS dateadd  FROM joboffre  
		  	INNER JOIN jobcategpro ON joboffre.domainepro=jobcategpro.orderjobcategpro
		  	INNER JOIN jobnivo ON joboffre.niveau_etud=jobnivo.orderjobnivo
		  	INNER JOIN jobtype ON joboffre.typecontrat=jobtype.orderjobtype
			INNER JOIN jobrecruteur ON joboffre.recruteur=jobrecruteur.orderjobrecruteur WHERE joboffre.recruteur=? AND DATEDIFF(expire_le, now())<0", [ $recruteur], false); 		
	}

	public function paginateInvalide($orderm, $offset, $nbperpage){
		return $this->tableQuery("SELECT *, DATE_FORMAT(joboffre.publier_le, '%d/%m/%Y') AS dateadd  FROM joboffre  
		  	INNER JOIN jobcategpro ON joboffre.domainepro=jobcategpro.orderjobcategpro
		  	INNER JOIN jobnivo ON joboffre.niveau_etud=jobnivo.orderjobnivo
		  	INNER JOIN jobtype ON joboffre.typecontrat=jobtype.orderjobtype 
			INNER JOIN jobrecruteur ON joboffre.recruteur=jobrecruteur.orderjobrecruteur WHERE joboffre.recruteur=? AND DATEDIFF(expire_le, now())<0 ORDER BY orderjoboffre DESC  LIMIT $offset, $nbperpage", [$orderm], false);
	}

/*Offres Masquees*/

	public function offreMasked($recruteur){
		$active=0;
		 $a=$this->tableQuery("SELECT *, DATE_FORMAT(joboffre.publier_le, '%d/%m/%Y') AS dateadd  FROM joboffre  
		  	INNER JOIN jobcategpro ON joboffre.domainepro=jobcategpro.orderjobcategpro
		  	INNER JOIN jobnivo ON joboffre.niveau_etud=jobnivo.orderjobnivo
		  	INNER JOIN jobtype ON joboffre.typecontrat=jobtype.orderjobtype
			INNER JOIN jobrecruteur ON joboffre.recruteur=jobrecruteur.orderjobrecruteur WHERE activation=? AND joboffre.recruteur=? ", [$active, $recruteur], false); 
		 return $a;
	}

	public function paginateMasked($orderm, $offset, $nbperpage){
		$active=0;
		return $this->tableQuery("SELECT *, DATE_FORMAT(joboffre.publier_le, '%d/%m/%Y') AS dateadd  FROM joboffre  
		  	INNER JOIN jobcategpro ON joboffre.domainepro=jobcategpro.orderjobcategpro
		  	INNER JOIN jobnivo ON joboffre.niveau_etud=jobnivo.orderjobnivo
		  	INNER JOIN jobtype ON joboffre.typecontrat=jobtype.orderjobtype 
			INNER JOIN jobrecruteur ON joboffre.recruteur=jobrecruteur.orderjobrecruteur WHERE activation=? AND joboffre.recruteur=? ORDER BY orderjoboffre DESC  LIMIT $offset, $nbperpage", [$active, $orderm ], false);
	}


	public function majlOffre($idoffre){
	  	return $this->tableQuery("SELECT *, DATE_FORMAT(joboffre.publier_le, '%d/%m/%Y') AS dateadd, DATE_FORMAT(joboffre.expire_le, '%d/%m/%Y') AS datexp  FROM joboffre 
	  	INNER JOIN jobcategpro ON joboffre.domainepro=jobcategpro.orderjobcategpro
	  	INNER JOIN jobnivo ON joboffre.niveau_etud=jobnivo.orderjobnivo
	  	INNER JOIN jobtype ON joboffre.typecontrat=jobtype.orderjobtype
	  	INNER JOIN jobrecruteur ON joboffre.recruteur=jobrecruteur.orderjobrecruteur
	  	 WHERE joboffre.idjoboffre=?", ["$idoffre"], true);
	}


/// SUM(payements.loyer) de table payements en fonction de l'idmaison, id locataire et l'idbailleur

	/*public function lectureOneMaison($idoffre){
	  	return $this->tableQuery("SELECT *, SUM(payements.montant_paye)  FROM patrimoines INNER JOIN bailleurs ON patrimoines.bailleur_id=bailleurs.iduniq_bailleurs INNER JOIN villes ON  patrimoines.ville_id=villes.idvilles INNER JOIN locataires ON  patrimoines.iduniq_pat=locataires.maison_iduniq WHERE  patrimoines.bailleur_id=?", ["$idoffre"], true);
	}*/




}