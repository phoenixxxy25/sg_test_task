<?
//include '././core/model.php';
class Post extends Model{

	function __construct(){
		parent::__construct('posts');
	}

	public function addPost($data){
		if(!$data || count($data) != 2 ) return false;
		$data = '"", "'.$data['author'].'", "'.$data['text'].'"';
		return $this->insert($data);
	}



	public function deletePost($id){
		return $this->delete($id);
	}

	public function selectAllPosts(){
		return $this->select();
	}

	public function selectPostComments($id){
		return $this->select('*', 'WHERE `post_id` = '.$id, 'comments');
	}

	public function selectCheckAuthor($user_login, $post_id){
		return $this->select('*', 'author = "'.$user_login.'" AND id = '.$post_id);
	}

	public function ks($a){
		return $this->pek($a);
	}
}