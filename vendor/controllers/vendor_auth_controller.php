<?php if (!defined('APPLICATION')) die ('Bad requested!');

class vendor_auth_controller extends vendor_controller {
  public function __construct() {
    // if($this->checkAuth()) {
    //   parent::__construct();
    // } else {
    //   header('Location: /?route=login');
    // }
  }

  public function checkAuth() {
    if (isset($_SESSION['user_info'])) return true;

    $token = isset($_COOKIE["user_token"]) ? $_COOKIE["user_token"] : null;
    $user_info = isset($_COOKIE['user_info']) ? json_decode($_COOKIE['user_info']) : null;
    if(!$user_info || !$token) return false;

    $model = new user_model();
    $result = $model->get("id_user, fullname, user_name, password", [
      "conditions" => [
        "user_name" => $user_info->username
      ]
    ])->fetch_assoc();

    if ($result['id_user'] != $user_info->id) return false;
    if ($result['user_name'] != $user_info->username)return false;
    if ($result['fullname'] != $user_info->fullname) return false;

    return $token == md5($result["user_name"] . $result["password"]);
  }
}