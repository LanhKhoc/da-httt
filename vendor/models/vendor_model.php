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
		// $conditions = isset($options["conditions"]) ? 'where ' . $options['conditions'] : '';
		$conditions = '';
		if(isset($options['conditions'])) {
			$conditions = 'WHERE ' . array_keys($options['conditions'])[0] . "='" . array_shift($options['conditions']) . "'";
			foreach($options['conditions'] as $key => $value) {
				if(strpos($key, '|') === 0) $conditions .= ' OR ' . mysqli_real_escape_string($this->conn, substr($key, 1)) . "='" . mysqli_real_escape_string($this->conn, $value) . "'";
				else if(strpos($key, '&') === 0) $conditions .= ' AND ' . mysqli_real_escape_string($this->conn, substr($key, 1)) . "='" . mysqli_real_escape_string($this->conn, $value) . "'";
				else $conditions .= ' AND ' . mysqli_real_escape_string($this->conn, $key) . "='" . mysqli_real_escape_string($this->conn, $value) . "'";
			}
		}

		$sql = "SELECT $fields FROM `$this->table` $conditions";
		return $this->conn->query($sql);
	}

	public function update() {}
	public function insert() {}
	public function delete() {}
}