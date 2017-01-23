<?
include_once '././core/controller.php';
include_once 'app/models/posts.php';

class C_Post extends Controller
{
	public $layouts = "p_layouts";

	function index($id = 0) {
		$loaderPost = new Post();
		$post = $loaderPost->select_item($id);
		$comments = $loaderPost->selectPostComments($id);
		$post_stuff = ['post' => $post, 'comments' => $comments ];

		$this->template->vars('post_stuff', $post_stuff);
		$this->template->view('post');

	}

	function add() {
		$this->template->view('add');
	}

	function addRequest() {
		if(!isset($_SESSION['user_id'])) exit('{"fail":"Ошибка: Авторизуйтесь для создания новый постов!"}');
		
		$loaderPost = new Post();
		$post = ['author' => 'YA', 'text' => $_POST['text']];
		$newpostid = $loaderPost->addPost($post);
		if($newpostid != false) exit('{"redirect":"post/'.$newpostid.'"}');
		else exit('{"fail":"fail"}');
	}

	function deleteRequest() {
		if(!isset($_SESSION['user_id'])) exit('{"delete_post_result":"Ошибка: Авторизуйтесь для удаления поста!"}');

		$loaderPost = new Post();

		if(isset($_POST['id']) && $_POST['id']*1 > 0){
			$idToDel =  $_POST['id']*1;

			$checkResult = $loaderPost->selectCheckAuthor($_SESSION['user_login'], $_POST['id']);
			if(!isset($checkResult) || !$checkResult){

				if($loaderPost->deletePost($idToDel)) exit('{"delete_post_result":"done"}');
				else exit('{"delete_post_result":"Ошибка удаления поста!"}');
			}
			else {
				exit('{"delete_post_result":"Ошибка удаления поста!"}');
			}
		}
		else exit('{"delete_post_result":"fail"}');
	
	}

}