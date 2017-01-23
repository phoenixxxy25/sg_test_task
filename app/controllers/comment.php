<?
//include '././core/controller.php';
include_once 'app/models/comment.php';

class C_Comment extends Controller
{
	function index($id = 0) {
		if(!isset($_SESSION['user_id'])) exit('{"fail":"Ошибка: Вы не авторизированы!"}');
		if(!isset($_POST)) exit('{"fail":"Ошибка!"}');

		$commentWorker = new Comment();


		if(isset($_POST['d']))
		{
			if($commentWorker->deleteComment($id)) exit('{"delete_result":"done"}');
			else exit('{"delete_result":"fail"');
		}

		else if(isset($_POST['r']))
		{
			if($commentWorker->rewriteComment($id, $_POST['ntext'])) exit('{"update_result":"'.$_POST['ntext'].'"}');
			else exit('{"update_result":"fail"}');
		}

		else if(isset($_POST['rt']))
		{
			$rate_try = $commentWorker->rateComment($id, 1);
			
			if(!$rate_try) exit('{"rate_result":"fail"');
			else exit('{"rate_result":"'.$rate_try[0]['rating'].'"}');	
		}

		else
		{
			$comment = ['author' => $_SESSION['user_login'], 'text' => $_POST['text']];
			$answ_comment_id = $commentWorker->addComment($comment , $id);

			exit('{"comment_author":"'.$comment['author'].'", "comment_text":"'.$comment['text'].'", "comment_id":"'.$answ_comment_id.'" }');
		}
	}

	

}
