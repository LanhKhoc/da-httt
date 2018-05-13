<?php session_start(); if (!defined('APPLICATION')) die ('Bad requested!');

class login_controller extends vendor_controller {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    if (vendor_auth_controller::checkAuth()) {
      if (empty($_SESSION['user_info'])) { $id = json_decode($_COOKIE['user_info'])->id; }
      else { $id = $_SESSION['user_info']['id']; }
      header('Location: ' . vendor_url_util::makeURL(['controller' => 'user', 'action' => 'edit', 'params' => ['id' => $id]]));
      die();
    }

    $error = [
      'username' => isset($_SESSION['error']['username']) ? $_SESSION['error']['username'] : '',
      'password' => isset($_SESSION['error']['password']) ? $_SESSION['error']['password'] : ''
    ];

    $remember = [
      'username' => isset($_SESSION['remember']['username']) ? $_SESSION['remember']['username'] : ''
    ];

    unset($_SESSION['error']);
    unset($_SESSION['remember']);

    $this->setProperty('error', $error);
    $this->setProperty('remember', $remember);
    $this->view();
  }

  public function check() {
    if($_SERVER['REQUEST_METHOD'] == 'GET') die();

    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $remember = isset($_POST['remember']) ? true : false;
    $service = new login_service();

    $result = $service->checkLogin($username, $password, $remember);

    if($result['status'] === true) {
      $id = $result['user_info']['id'];
      header('Location: ' . vendor_url_util::makeURL(['controller' => 'user', 'action' => 'edit', 'params' => ['id' => $id]]));
    } else {
      header('Location: ' . vendor_url_util::makeURL(['controller' => 'login']));
    }
  }

  public function logout() {
    if (isset($_SESSION['user_info'])) { unset($_SESSION['user_info']); }
    else {
      setcookie('user_token', '', 0, '/');
      setcookie('user_info', '', 0, '/');
    }

    header('Location: ' . vendor_url_util::makeURL(['login']));
  }
}