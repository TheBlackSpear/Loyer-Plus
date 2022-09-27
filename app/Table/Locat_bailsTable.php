<?php 
/**
* php:Alain KIKOUN
**/
 ?>
<?php  
namespace App\Table;

use Core\Table\Table;

class Locat_bailsTable extends Table{

	protected $table="locat_bails";


	public function categorieList(){
		return $this->tableQuery("SELECT * FROM btkcateg ORDER BY btkcateg_lib ASC");
	}
	public function blogList(){
		$active=1;
		return $this->tableQuery("SELECT * FROM blog INNER JOIN btkcateg ON blog.categorie_order=btkcateg.orderbtkcateg WHERE blog_active=? ORDER BY orderblog DESC", [$active],false);
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
		return $this->tableQuery("SELECT * FROM btkcateg WHERE orderbtkcateg=? ", [$idcat], true);

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