<?php
require_once('config.php');
require_once('function.php');
require_once('classes.php');

$todoInstance = new Todo();
$todos = $todoInstance->getTodos();

var_dump($todos);
//exit();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>Todo App</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div id="container">
		<h1>やることリスト</h1>
		<form action="">
			<input type="text" placeholder="タスクを入力してください" id="new">
		</form>
		<ul>
			<?php foreach($todos as $todo){ ?>
				<li>
					<form id="flag_form" method="post" action="">
						<input type="checkbox" class="flag" <?php if($todo->flag == '1'){ echo 'checked'; } ?> onchange="document.forms.flag_form.submit();">
						<input type="hidden" name="" value="">
					</form> 
					<span <?php if($todo->flag == '1'){ echo 'class="done"'; } ?>><?= $todo->content ?></span>
					<button type="submit" value="" onclick="">削除</button>
				</li>
			<?php } ?>
		</ul>
	</div>
</body>
</html>
