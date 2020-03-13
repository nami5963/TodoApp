<?php

class Todo {
	public $db;

	public function connectDB(){
		try{
                        $this->db = new PDO(DSN, DB_USER, DB_PASS);
                        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                } catch(PDOException $e) {
                        echo $e->getMessage();
                        exit();
		}
	}

	public function getTodos(){
		$sql = "select * from todos where user_id = :user_id order by id desc";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function post(){
		if(!empty($_POST['post'])){
			if($_POST['csrf_token'] == $_SESSION['csrf_token']){
				$post_sql = "insert into todos (user_id, content) values (:user_id, :content)";
				$stmt = $this->db->prepare($post_sql);
				$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
				$stmt->bindParam(':content', escape($_POST['post']), PDO::PARAM_STR);
				$stmt->execute();
			}else{
				echo 'invalid post!!';
			}
		}else{
			echo 'タスクが入力されていません。';
		}
	}

	public function flag_change(){
		if($_POST['flag_status'] == '0'){
			$flag_sql = "update todos set flag = '1' where id = :id";
		}else{
			$flag_sql = "update todos set flag = '0' where id = :id";
		}
		$stmt = $this->db->prepare($flag_sql);
		$stmt->bindParam(':id', $_POST['change_data_id'], PDO::PARAM_STR);
		$stmt->execute();
	}

	public function delete(){
		$delete_sql = "delete from todos where id = :id";
		$stmt = $this->db->prepare($delete_sql);
		$stmt->bindParam(':id', $_POST['delete_data_id'], PDO::PARAM_STR);
		$stmt->execute();
	}
}

class User {
	public $db;

	public function connectDB(){
                try{
                        $this->db = new PDO(DSN, DB_USER, DB_PASS);
                        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                } catch(PDOException $e) {
                        echo $e->getMessage();
                        exit();
                }
        }

	public function get_login_user() {
		$login_sql = "select * from users where name = :name";
		$stmt = $this->db->prepare($login_sql);
		$stmt->bindParam(':name', escape($_POST['name']), PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function login($login_user) {
		if(!$login_user || $login_user->password !== sha1(escape($_POST['password']))){
                	echo '入力に誤りがあります。';
		}else{
			$_SESSION = [];
			session_regenerate_id();
                	if(!isset($_SESSION['csrf_token'])) {
                        	$_SESSION['csrf_token'] = sha1(mt_rand());
			}
			$_SESSION['user_id'] = $login_user->id;
                	$_SESSION['name'] = escape($_POST['name']);
                	header('Location: list.php');
		}
	}

	public function register() {
		try{
			$register_sql = "insert into users (name, password) values (:name, :password)";
			$stmt = $this->db->prepare($register_sql);
			$stmt->bindParam(':name', escape($_POST['name']), PDO::PARAM_STR);
			$stmt->bindParam(':password', sha1(escape($_POST['password'])), PDO::PARAM_STR);
			$stmt->execute();
			header('Location: register_complete.php');
		}catch(PDOException $e){
			echo '既にその名前とパスワードの組み合わせが存在しています。';
		}
	}
}


