<?
//include '././core/controller.php';
//include_once 'app/models/comment.php';
include_once 'app/models/user.php';

class C_User extends Controller
{

	public $layouts = "v_layouts";

	function index($id = 0) {
		print_r('index user page');
	}

	function login() {
		$a = rand(1, 10); $b = rand(1, 10);
		$_SESSION['captcha'] = $a + $b;
		$captcha_val = "$a + $b";

		$this->template->vars('captcha_val', $captcha_val);
		$this->template->view('login');

	}

	function registration(){
		$a = rand(1, 10); $b = rand(1, 10);
		$_SESSION['captcha'] = $a + $b;
		$captcha_val = "$a + $b";

		$this->template->vars('captcha_val', $captcha_val);
		$this->template->view('registration');
	}


	function loginRequest(){
		if(!isset($_POST['captcha'])) exit('{"fail":"Ошибка: Введите каптчу!"}');
		else if($_POST['captcha'] != $_SESSION['captcha']) exit('{"fail":"Ошибка: Каптча введена не верно!"}');

		if(isset($_POST['login']) AND isset($_POST['password'])) {
			$user = new User();
			$loginResult = $user->selectUser(['login' => $_POST['login'], 'password' => md5($_POST['password'])]);
			if($loginResult){
				foreach($loginResult as $key => $value) {
					$_SESSION['user_' . $key] = $value;
				}

				exit('{"redirect":""}');
			}
			else exit('{"fail":"Ошибка: Пользователь не найден!"}');
		}
		else exit('{"fail":"fail"}');

	}

	function registrationRequest(){
		if(!isset($_POST['captcha'])) exit('{"fail":"Ошибка: Введите каптчу!"}');
		else if($_POST['captcha'] != $_SESSION['captcha']) exit('{"fail":"Ошибка: Каптча введена не верно!"}');

		if(isset($_POST['login']) AND isset($_POST['password'])) {
			$user = new User();
			
			$user->addUser(['login' => $_POST['login'], 'password' => md5($_POST['password'])]);

			exit('{ "redirect" : "user/login"}');
		}
	}

	function exitRequest(){
		session_destroy();
		header('Location: /');
	}

}