<?php
require_once('config.php');
require_once('function.php');
require_once('classes.php');

$todoInstance = new Todo();
$todoInstance->connectDB();

if(isset($_POST['post'])){
	$todoInstance->post();
}

if(isset($_POST['data_id'])){
	$todoInstance->flag_change();
}

$todos = $todoInstance->getTodos();

//var_dump($todos);
//exit();

$counter = 1;

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
		<form action="" method="post">
			<input type="text" name="post" placeholder="タスクを入力してください" id="new">
		</form>
		<ul>
			<?php foreach($todos as $todo){ ?>
				<li>
					<form id="flag_form" method="post" action="">
						<input type="checkbox" class="flag" <?php if($todo->flag == '1'){ echo 'checked'; } ?> onchange="document.forms[<?= $counter ?>].submit();">
						<input type="hidden" name="data_id" value="<?= $todo->id ?>">
						<input type="hidden" name="flag_status" value="<?= $todo->flag ?>">
					</form> 
					<span <?php if($todo->flag == '1'){ echo 'class="done"'; } ?>><?= $todo->content ?></span>
					<button type="submit" value="" onclick="">削除</button>
					<!-- <span><?= $todo->id ?></span> -->
				</li>
			<?php $counter ++; ?>
			<?php } ?>
		</ul>
	</div>
</body>
</html>
