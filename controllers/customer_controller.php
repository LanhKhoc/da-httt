<?php

class customer_controller extends vendor_controller {
  public function index() {
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $service = new customer_service();
    $data = $service->getAll($page);

    $this->setProperty('data', $data);
    $this->view();
  }
}