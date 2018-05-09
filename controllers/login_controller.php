<?php session_start(); if (!defined('APPLICATION')) die ('Bad requested!');

class login_controller extends vendor_controller {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
    if (isset($_SESSION['login_error'])) { unset($_SESSION['login_error']); }

    $this->setProperty('error', $error);
    $this->view();
  }

  public function check() {
    if($_SERVER['REQUEST_METHOD'] == 'GET') die();

    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $model = new login_model();

    $result = $model->checkLogin($username, $password);

    if($result['logged']) {
      $_SESSION['user_info'] = [
        'full_name' => $result['full_name']
      ];
      header('Location: ' . vendor_url_util::makeURL(['controller' => 'user']));
    } else {
      $_SESSION['login_error'] = 'Username/Password incorrect';
      header('Location: ' . vendor_url_util::makeURL(['controller' => 'login']));
    }
  }

  // public function store() {
  //   $model = new user_model();
  //   $model->store([
  //     'user_name' => ?
  //   ]);
  // }
  
  // public function destroy() {
  //   $model->destroy(['id' => 1]);
  // }

  // public function update() {
  //   $model->update($id, [
  //     'password' => $password
  //   ])
  // }
}