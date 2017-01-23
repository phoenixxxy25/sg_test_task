<?

Class Router {

	private $path;
	private $args = array();

	function __construct() {
	}

	function setPath($path) {
        $path = trim($path, '/\\');
        $path .= DS;

        if (is_dir($path) == false) {
			throw new Exception ('Invalid controller path: `' . $path . '`');
        }

        $this->path = $path;
	}	

	private function getController(&$file, &$controller, &$action, &$args, &$id) {
        $route = (empty($_GET['route'])) ? '' : $_GET['route'];
		$action = (empty($_GET['action'])) ? '' : $_GET['action'];
        $id = (empty($_GET['id'])) ? 0 : $_GET['id'];

        $id *= 1;

		unset($_GET['route']);
        if (empty($route)) {
			$route = 'index';
		}

        $route = trim($route, '/\\');
        $parts = explode('/', $route);

        $cmd_path = $this->path;

        foreach ($parts as $part) {
			$fullpath = $cmd_path . $part;

			
			if (is_dir($fullpath)) {
				$cmd_path .= $part . DS;
				array_shift($parts);
				continue;
			}

			
			if (is_file($fullpath . '.php')) {
				$controller = $part;
				array_shift($parts);
				break;
			}
        }
		
        if (empty($controller)) {
			$controller = 'index'; 
		}

        $action = array_shift($parts);
        if (empty($action)) { 
			$action = 'index'; 
		}

		$file = $cmd_path . $controller . '.php';
        $args = $parts;
	}
	
	function start() {
        $this->getController($file, $controller, $action, $args, $id);

        if (is_readable($file) == false) {
			die ('404 Not Found');
        }

        include ($file);

        $class = 'C_' . $controller;
        $controller = new $class();


        if (is_callable(array($controller, $action)) == false) {
			die ('404 Not Found');
        }

        if($id > 0) $controller->$action($id);
        else $controller->$action();

	}
}
