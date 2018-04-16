<?php

class login_controller extends vendor_controller {
  public function __contruct() {
    parent::__contruct();
  }

  public function index() {
    $this->view();
  }
}