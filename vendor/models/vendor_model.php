<?php

class vendor_model {
	protected $table;
	protected $conn;

	public function __construct() {
    global $DB_CONFIG;

		$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if(mysqli_connect_error()) {
			echo 'Failed to connect to MySQL' . mysqli_connect_error();
			exit();
		}
	}

	public function get($fields = "*", $options = null) {
		$conditions = isset($options["conditions"]) ? 'where ' . $options['conditions'] : '';
		$sql = "SELECT $fields FROM `$this->table` $conditions";
		echo $sql;
		return $this->conn->query($sql);
	}

	public function update() {}
	public function insert() {}
	public function delete() {}
}