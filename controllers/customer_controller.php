<?php session_start();

class customer_controller extends vendor_controller {
  public function index() {
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $service = new customer_service();
    $data = $service->getAll($page);

    $this->setProperty('data', $data);
    $this->view();
  }

  public function show() {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if ($id == null) { die(); }

    $service = new customer_service();
    $data = $service->getInfoCustomer($id);

    $this->setProperty('data', $data);
    $this->view();
  }
}