<?php if (!defined('APPLICATION')) die ('Bad requested!');

class vendor_auth_controller extends vendor_controller {
  public function __construct() {
    if($this->checkAuth()) {
      parent::__construct();
    } else {
      header('Location: /?route=login');
    }
  }

  public function checkAuth() {
    return isset($)
  }
}