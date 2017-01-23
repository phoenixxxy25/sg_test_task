<?
function __autoload($className) {
	$filename = strtolower($className) . '.php';
	$expArr = explode('_', $className);


	if(empty($expArr[1]) OR $filename == 'controller'){
		$folder = 'core';			
	}else{			
		switch(strtolower($expArr[0])){
			case 'controller':
				$folder = 'app/controllers';	
				break;
				
			case 'model':					
				$folder = 'app/models';	
				break;
				
			default:
				$folder = 'core';
				break;
		}
	}
	$file = SITE_PATH . $folder . DS . $filename;

	if (file_exists($file) == false) {
		return false;
	}		

	include ($file);
}
