<?
//include '././core/model.php';
class User extends Model{

	function __construct(){
		parent::__construct('users');
	}

	public function addUser($data){
		if(!$data || count($data) != 2) return false;

		$user = '"", "'.$data['login'].'", "'.$data['password'].'"';

		return $this->insert($user);
	}

	public function selectUser($data){
		if(!$data || count($data) != 2) return false;
		$data = 'login = "'.$data['login'].'" AND password = "'.$data['password'].'"';
		return $this->select_item(0, 'users', $data);
	}


}
