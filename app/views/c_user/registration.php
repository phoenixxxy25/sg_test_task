<h1>Регистрация</h1>

<div id="fail_message_pool"></div>
<p><input type="text" placeholder="Логин" id="login"></p>
<p><input type="password" placeholder="Пароль" id="password"></p>
<p><input type="text" placeholder="<?=$captcha_val?>" id="captcha"></p>
<p><button onclick="post_query('registration', 'registration', 'login.password.captcha')">Регистрация</button></p>
