<?php

class login_controller extends vendor_controller {
  public function __contruct() {
    parent::__contruct();
  }

  public function index() {
    $this->view([
      "controller" => "login",
      "action" => "index"
    ]);
  }

  // NOTE: Only POST can go into this method
  // If GET then exit application
  public function check() {
    if($_SERVER['REQUEST_METHOD'] == 'GET') exit();

    $username = isset($_POST["username"]) ? $_POST["username"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    $model = new login_model();

    if($model->check($username, $password)) {
      echo "Login Success";
    } else {
      // header("Location: /?route=login/index");
    }
  }
}