<?php

class login_model extends vendor_model {
  protected $table = 'user';

  public function __contruct() {
    parent::__contruct();
  }

  public function check($username, $password) {
    $row = $this->get("salt", [
      "conditions" => [
        'user_name' => $username
      ]
    ])->fetch_assoc();

    $passSalt = md5($password + $row['salt']);

    // $result = $this->get('*', [
    //   'conditions' => 'user_name = '{$username}' AND password = '{$passSalt}''
    // ])->num_rows;

    $result = $this->get('*', [
      'conditions' => [
        'user_name' => 'admin',
        '&password' => $passSalt
      ]
    ])->num_rows;
    return $result > 0;
  }
}