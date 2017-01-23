<?
include '././core/controller.php';
include_once 'app/models/posts.php';

class C_Index extends Controller
{
	public $layouts = "v_layouts";

	function index() {

		$newposts = new Post();

		$allPosts = $newposts->selectAllPosts();

		$this->template->vars('allPosts', $allPosts);
		$this->template->view('index');
	}
}