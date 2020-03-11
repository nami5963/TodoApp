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
}

