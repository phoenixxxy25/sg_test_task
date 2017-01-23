<?
include '././core/model.php';
class Comment extends Model{

	function __construct(){
		parent::__construct('comments');
	}

	public function addComment($data, $id){
		if(!$data) return false;

		$comment = '"", '.$id.', "'.$data['author'].'", "'.$data['text'].'", 0';

		return $this->insert($comment);
	}

	public function selectAllComments(){
		return $this->select();
	}

	public function selectPostComments($id){
		return $this->select('*', 'WHERE `post_id` = '.$id, 'comments');
	}

	public function deleteComment($id){
		return $this->delete($id);
	}

	public function rewriteComment($id, $text){
		return $this->update($id, "text='$text'");
	}

	public function rateComment($id, $rate_val) {

		$extras_check = $this->select(0, 'WHERE comment_id = '.$id.' AND user_id = 1', 'comment_extras');
		if(!$extras_check){
			$extras = '"", '.$id.', 1';
		    $this->insert($extras, '', 'comment_extras');
		 	$this->update($id, 'rating=rating+'.$rate_val,'', 'comments');
		 	$rating = $this->select(0, 'WHERE id = '.$id, 'comments');
		 	return $rating;
		}
		else return false;
	}
}