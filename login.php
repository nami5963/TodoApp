<?php

session_start();

require_once('config.php');
require_once('function.php');
require_once('classes.php');

$loginInstance = new User();
$loginInstance->connectDB();

if(isset($_POST['name'])){
	$login_user = $loginInstance->get_login_user();
	$loginInstance->login($login_user);
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>Login Page</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div id="container">
		<h1>ログインページ</h1>
		<form action="" method="post">
			<input type="text" name="name" placeholder="名前を入力してください" class="login" required><br>
			<input type="password" name="password" placeholder="パスワードを入力してください" class="login" required>
			<button type="submit" class="log_btn">ログイン</button>
			<button type="button" class="log_btn" onclick="location.href='register.php'">ユーザー登録ページへ</button>
		</form>
	</div>
</body>
</html>
