<?php

class Todo {
	public $db;

	public function getTodos(){
		try{
			$this->db = new PDO(DSN, DB_USER, DB_PASS);
                        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                } catch(PDOException $e) {
			echo $e->getMessage();
                        exit();
                }
		$sql = "select * from todos order by id desc";
		$stmt = $this->db->query($sql);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
}

