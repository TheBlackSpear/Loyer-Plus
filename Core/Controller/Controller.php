<?php 
/**
* Author:Alain KIKOUN 
**/
 ?>
<?php 
namespace Core\Controller;

class Controller{

	protected $template;
	protected $viewpath;

	protected function render($view, $variables=[]){
		ob_start();
		//var_dump($variables);
		extract($variables);
		require($this->viewpath.str_replace('.', '/', $view).'.php');
		$content=ob_get_clean();
		require($this->viewpath.'templates/'.$this->template.'.php');
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