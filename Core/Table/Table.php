<?php 
namespace Core\Table;
use Core\Database\Database;


class Table{

	protected $table;
	private $db;

	public function __construct(Database $db)
	{	$this->db=$db;
		if ($this->table===null || $this->table==='')
		{
		$parties=explode('\\', get_class($this)); 
		$table=strtolower(str_replace('Table','',end($parties))).'s';
		$this->table=$table;
		}
	}

	/* !!!---Methode de pagination ----*/
	public function paginateMethode($offset, $nbperpage){
		/* ----CONTENU DU CONTROLLER----
		if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;
        $total_pages = ceil(count($nbredentrees_datatable) / $no_of_records_per_page);*/
		return $query=$this->tableQuery("SELECT * FROM {$this->table} LIMIT $offset, $nbperpage"); //var_dump($query);
	}

	/* !!!---Read singleton, liste... ----*/
	public function all(){
		return $query=$this->tableQuery("SELECT * FROM {$this->table}"); //var_dump($query);
	}

	/**
	 * Récupère un article en liant la catégorie appropriée
	 *@param $id int
	 *@return \App\Entity\PostEntity
	 */	
	public function findById($id){
		$idtable='id'.$this->table;
		return $this->tableQuery("SELECT * FROM {$this->table} WHERE $idtable=?", [$id],true);
	}	

	public function findOnline(){
		$online=1;
		return $this->tableQuery("SELECT * FROM {$this->table} WHERE online=?", [$online],false);
	}
	
	/*Liste ...*/	
	public function liste($cle, $valeur){
		$records=$this->all();
		$return=[];
		foreach($records as $v){
			$return[$v->$cle]=$v->$valeur;
		}
		return $return;
	}
	/* !!!---Read singleton, liste... ----*/

	/* ---Create Real_Multiple Update Delete ----*/
	public function create($fields){
		$sql_parts=[];
		$attributs=[];
		foreach ($fields as $k => $v) {
			$sql_parts[]="$k=?"; //var_dump($sql_parts);
			$attributs[]=$v;
		}
		
		$sql_part=implode(',',$sql_parts);
		return $this->tableQuery("INSERT INTO {$this->table} SET $sql_part", $attributs, true);
	}

	public function update($id, $fields){
		$sql_parts=[];
		$attributs=[];
		foreach ($fields as $k => $v) {
			$sql_parts[]="$k=?"; //var_dump($sql_parts);
			$attributs[]=$v;
		}
		$attributs[]=$id;
		$sql_part=implode(',',$sql_parts);		
		return $this->tableQuery("UPDATE {$this->table}	SET $sql_part WHERE id{$this->table}=?", $attributs, true);
	}

	public function delete($id){			
		return $this->tableQuery("DELETE FROM {$this->table} WHERE order{$this->table}=?", [$id], true);
	}
	/* !-- Create Update Delete---*/

	/*Méthode gérant le CRUD en Query ou Prepare.Toutes les Méthodes de cette classe Table s'appuient sur tableQuery */

	public function tableQuery($sql,$attributs=null,$one=false){
		if($attributs){
			$resultats=$this->db->dbprepare(
				$sql,
				$attributs,
				str_replace('Table','Entity',get_class($this)),
				$one
			); 
		}
		else
		{
			$resultats=$this->db->dbQuery(
				$sql,
				str_replace('Table','Entity',get_class($this)),
				$one
			);//var_dump($resultats);
		}
		
		return $resultats;
	}




}