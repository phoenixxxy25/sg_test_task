<?
//include 'template.php';
Abstract class Controller 
{

	protected $template;
	protected $layouts;
	
	public $vars = array();

	function __construct() {
		$this->template = new Template($this->layouts, get_class($this));
	}

	abstract function index();
}