<?php
require_once('config.php');
require_once('function.php');
require_once('classes.php');

$todoInstance = new Todo();
$todoInstance->connectDB();

if(isset($_POST['post'])){
	$todoInstance->post();
}

if(isset($_POST['change_data_id'])){
	$todoInstance->flag_change();
}

if(isset($_POST['delete_data_id'])){
	$todoInstance->delete();
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
						<input type="hidden" name="change_data_id" value="<?= $todo->id ?>">
						<input type="hidden" name="flag_status" value="<?= $todo->flag ?>">
					</form> 
					<span <?php if($todo->flag == '1'){ echo 'class="done"'; } ?>><?= $todo->content ?></span>
					<form id="delete_form" method="post" action="">
						<button type="submit" name="delete_data_id" value="<?= $todo->id ?>">削除</button>
					</form>
					<!--<span><?= $todo->id ?></span> -->
				</li>
			<?php $counter += 2; ?>
			<?php } ?>
		</ul>
	</div>
</body>
</html>
