<?php if (!defined('APPLICATION')) die ('Bad requested!');

class login_model extends vendor_model {
  // NOTE: Name table in database
  protected $table = "user";

  public function __construct() {
    parent::__construct();
  }

  public function checkLogin($username, $password) {
    $result = $this->get("*", [
      "conditions" => [
        "user_name" => $username,
        "password" => md5($password)
      ]
    ]);
    $data = $result->fetch_assoc();

   return [
     'logged' => $result->num_rows > 0,
     'full_name' => $data['full_name']
   ];
  }
}