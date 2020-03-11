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
		$sql = "select * from todos order by id desc";
		$stmt = $this->db->query($sql);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function post(){
		$post_sql = "insert into todos (content) values (:content)";
		$stmt = $this->db->prepare($post_sql);
		$stmt->bindParam(':content', $_POST['post'], PDO::PARAM_STR);
		$stmt->execute();
	}

	public function flag_change(){
		if($_POST['flag_status'] == '0'){
			$flag_sql = "update todos set flag = '1' where id = :data_id";
		}else{
			$flag_sql = "update todos set flag = '0' where id = :data_id";
		}
		$stmt = $this->db->prepare($flag_sql);
		$stmt->bindParam(':data_id', $_POST['data_id'], PDO::PARAM_STR);
		$stmt->execute();
	}
}

