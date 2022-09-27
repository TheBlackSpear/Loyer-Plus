<?php 
/**
* php:Alain KIKOUN
**/
 ?>
<?php 

namespace Core\Database;
use \PDO;

class MysqlDatabase extends Database
{

	private $dbName;
	private $dbHost;
	private $dbPort;
	private $dbUser;
	private $dbPass;

	private $pdo;


	public function __construct(
								$db_name,
								$db_host,
								$db_port,
								$db_user,
								$db_pass)
	{
		$this->dbName=$db_name;
		$this->dbHost=$db_host;
		$this->dbPort=$db_port;
		$this->dbUser=$db_user;
		$this->dbPass=$db_pass;
	}


	public function getPDO(){

		if($this->pdo===null)
		{
			$bdd=$this->dbName;
			$host=$this->dbHost;
			$dbport=$this->dbPort;
			$bdduser=$this->dbUser;
			$bddpass=$this->dbPass;
			/*$pdo=new PDO('mysql:dbname=beventdd;dbhost=localhost;port=3306','root','',
						array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));*/
			$pdo=new PDO('mysql:host='.$host.'; port='.$dbport.'; dbname='.$bdd, $bdduser, $bddpass,
						array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			$this->pdo=$pdo;
		}
		return $this->pdo; /*port 3306 ou 3308*/
	}


	public function dbQuery($sql, $currentClasse=null, $one=false)
	{
		$resultats= $this->getPDO()->query($sql); //var_dump($resultats);

		if(
			strpos($sql,'UPDATE')===0||
			strpos($sql,'INSERT')===0||
			strpos($sql,'DELETE')===0
		){
			return $resultats;
		}

		if($currentClasse===null)
		{
			$resultats->setFetchMode(PDO::FETCH_OBJ);
		}
		else
		{
			$resultats->setFetchMode(PDO::FETCH_CLASS, $currentClasse);
		}

		if($one)
		{
			return $produits=$resultats->fetch();
		}
		else
		{
			return $produits=$resultats->fetchAll();
		}
	}


	public function dbPrepare($sql, $attributs, $currentClasse=null, $one=false)
	{
		//var_dump($attributs);
		$resultats= $this->getPDO()->prepare($sql); 
		$solutions=$resultats->execute($attributs);
		/*$coun=count($solutions);
		var_dump($coun);
		var_dump($solutions);*/

		if(
			strpos($sql,'UPDATE')===0||
			strpos($sql,'INSERT')===0||
			strpos($sql,'DELETE')===0
		){
			return $solutions;
		}

		if($currentClasse===null)
		{
			$resultats->setFetchMode(PDO::FETCH_OBJ);
		}
		else
		{
			$resultats->setFetchMode(PDO::FETCH_CLASS, $currentClasse);
		}

		if($one)
		{
			$produits=$resultats->fetch();
		}
		else{$produits=$resultats->fetchAll();}

		return $produits;		
	}


}
