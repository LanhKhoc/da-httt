<?php

class user_controller extends vendor_controller {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $this->data = [
      ["user_name" => "admin", "dob" => "01/03/1990"],
      ["user_name" => "user01", "dob" => "01/11/1993"]
    ];

    // $this->dataToView($data);
    $this->view();
  }
}