<?php 
/**
* php:Alain KIKOUN
**/
 ?>
<?php  
namespace App\Table;

use Core\Table\Table;

class CategorieTable extends Table{

	protected $table="categorie";


	public function categorieList(){
		return $this->tableQuery("SELECT * FROM categorie");
	}
	public function blogList(){
		$active=1;
		return $this->tableQuery("SELECT * FROM blog INNER JOIN categorie ON blog.categorie_order=categorie.ordercategorie WHERE blog_active=? ORDER BY orderblog DESC", [$active],false);
	}

	public function blogListByCategory(){
		$id=1;
		/*$v=1;
		$l=1;*/
		return $this->tableQuery("SELECT * FROM blog WHERE orderblog=?", [$id],false);
	}

	public function blogByCategory(){
		$id=1;
		/*$v=1;
		$l=1;*/
		return $this->tableQuery("SELECT * FROM blog WHERE orderblog=?", [$id],true);
	}

	public function singleCat($idcat){
		return $this->tableQuery("SELECT * FROM categorie WHERE ordercategorie=? ", [$idcat], true);

	}


	public function find($id){

		return $this->tableQuery("SELECT * FROM blog ");
	}

	/*public function findById($id){

		$coln=explode('_', $this->table);
		$coln=end($coln); 

		return $this->tableQuery("SELECT * FROM blog WHERE id=?", [$id],true);
	}*/

}