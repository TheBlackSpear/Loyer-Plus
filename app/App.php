<?php 
/**
* Author:Alain KIKOUN
**/
 ?>
<?php 
use Core\Config;
use Core\Database\MysqlDatabase;

class App{

	//public $title='test_App';
	private $db_instance;
	private static $instance;


	public static function getInstanceApp()
	{
		if(self::$instance===null){
			self::$instance= new App();
		}
		return self::$instance;
	}

	public function getTable($tableName){
		$classeName= '\\App\\Table\\'.ucfirst($tableName).'Table';
		$classeName= new $classeName($this->getDatabase()); //var_dump($classeName);
		return $classeName;
	}

	public static function loadage()
	{
		session_start();

		require ROOT. '/app/Autoloader.php';
		App\Autoloader::register();
		require ROOT. '/Core/Autoloader.php';
		Core\Autoloader::register();		
	}


	//Appel de methodes de core/config
	public function getDatabase()
	{
		$config=Config::configInstance(ROOT.'/config/config.php');
		if($this->db_instance===null){
			$db=new MysqlDatabase(
									$config->get('db_name'),
									$config->get('db_host'),
									$config->get('db_port'),
									$config->get('db_user'),
									$config->get('db_pass')
								);
			$this->db_instance=$db;
		}
		return $this->db_instance;
	}

	public function forbidden()
	{
		header('HTTP/1.0 403 Forbidden');
		 die('Acces Interdit');
	}

	public function notFound()
	{
		header('HTTP/1.0 404 Not Found');
		 die('Page Introuvable!');
	}



	
}