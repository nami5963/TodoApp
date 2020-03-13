<?php

session_start();

require_once('config.php');
require_once('function.php');
require_once('classes.php');

$registerInstance = new User();
$registerInstance->connectDB();

if(isset($_POST['name'])){
        $registerInstance->register();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
        <meta charset="utf-8">
        <title>User Register Page</title>
        <link rel="stylesheet" href="styles.css">
</head>
<body>
        <div id="container">
                <h1>ユーザー登録ページ</h1>
                <form action="" method="post">
                        <input type="text" name="name" placeholder="名前を入力してください" class="login" required><br>
                        <input type="password" name="password" placeholder="パスワードを入力してください" class="login" required>
			<button type="submit" class="log_btn">登録</button>
			<button type="button" class="log_btn" onclick="location.href='login.php'">ログインページへ</button>
                </form>
        </div>
</body>
</html>
