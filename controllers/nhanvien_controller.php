<?php session_start(); if (!defined('APPLICATION')) die ('Bad requested!');

class nhanvien_controller extends vendor_controller {
  public function  __construct() {
    parent::__construct();
  }

  private function loginMiddleware() {
    if(vendor_auth_controller::checkAuth() === false) {
      header('Location: ' . vendor_url_util::makeURL(['controller' => 'login']));
      die();
    }
  }

  public function index() {
    $idpb = isset($_GET['idpb']) ? $_GET['idpb'] : null;
    $model = new nhanvien_model();
    $data = [];
    $data['nhanvien'] = true;

    // NOTE: Check user logged?
    $data['user_logged'] = vendor_auth_controller::checkAuth();

    if($idpb == null) {
      $result = $model->get('*', [
        'relations' => [
          'inner join' => [
            'table' => 'PHONGBAN',
            'conditions' => '`PHONGBAN`.idpb = `NHANVIEN`.idpb'
          ]
        ]
      ]);
    } else {
      $result = $model->get('*', [
        'conditions' => ['idpb' => $idpb],
        'relations' => [
          'inner join' => [
            'table' => 'PHONGBAN',
            'conditions' => '`PHONGBAN`.idpb = `NHANVIEN`.idpb'
          ]
        ]
      ]);
    }

    while($row = $result->fetch_assoc()) { $data['data'][] = $row; }

    $this->setProperty('data', $data);
    $this->view();
  }

  public function create() {
    $this->loginMiddleware();

    $data = [];
    $data['nhanvien'] = true;

    $data['error']['idnv'] = isset($_SESSION['error']['idnv']) ? $_SESSION['error']['idnv'] : '';
    $data['error']['hoten'] = isset($_SESSION['error']['hoten']) ? $_SESSION['error']['hoten'] : '';
    $data['error']['diachi'] = isset($_SESSION['error']['diachi']) ? $_SESSION['error']['diachi'] : '';

    $data['remember']['idnv'] = isset($_SESSION['remember']['idnv']) ? $_SESSION['remember']['idnv'] : '';
    $data['remember']['hoten'] = isset($_SESSION['remember']['hoten']) ? $_SESSION['remember']['hoten'] : '';
    $data['remember']['diachi'] = isset($_SESSION['remember']['diachi']) ? $_SESSION['remember']['diachi'] : '';

    session_destroy();

    $phongban_model = new phongban_model();
    $result = $phongban_model->get('idpb, mota');

    while ($row = $result->fetch_assoc()) {
      $data['list_phongban'][] = $row;
    }

    $this->setProperty('data', $data);
    $this->view();
  }

  public function store() {
    if($_SERVER['REQUEST_METHOD'] == 'GET') { die('302'); }
    $this->loginMiddleware();

    $idnv = isset($_POST['idnv']) ? $_POST['idnv'] : '';
    $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '';
    $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';
    $phongban = isset($_POST['phongban']) ? $_POST['phongban'] : '';

    $model = new nhanvien_model();
    if ($model->store([
      'idnv' => $idnv,
      'hoten' => $hoten,
      'diachi' => $diachi,
      'idpb' => $phongban
    ])) {
      header('Location: ' . vendor_url_util::makeURL(['action' => 'index']));
    } else {
      header('Location: ' . vendor_url_util::makeURL(['action' => 'create']));
      die();
    }
  }

  public function search() {
    $this->loginMiddleware();

    $type = isset($_GET['type']) ? $_GET['type'] : null;
    $search = isset($_GET['search']) ? $_GET['search'] : null;

    $model = new nhanvien_model();
    $result = $model->search($type, $search);

    $data = [];
    while($row = $result->fetch_assoc()) { $data['data'][] = $row; }

    // NOTE: Check user logged?
    $data['user_logged'] = vendor_auth_controller::checkAuth();

    echo json_encode($data);
  }

  public function edit() {
    $this->loginMiddleware();

    $idnv = isset($_GET['idnv'])? $_GET['idnv'] : null;
    if(!$idnv) { header('Location: ' . vendor_url_util::makeURL(['action' => 'index'])); die(); }

    $data = [];
    $data['nhanvien'] = true;

    $model = new nhanvien_model();
    $result = $model->get('*', [
      'conditions' => [
        'idnv' => $idnv
      ]
    ])->fetch_assoc();

    $data['error']['idnv'] = isset($_SESSION['error']['idnv']) ? $_SESSION['error']['idnv'] : '';
    $data['error']['hoten'] = isset($_SESSION['error']['hoten']) ? $_SESSION['error']['hoten'] : '';
    $data['error']['diachi'] = isset($_SESSION['error']['diachi']) ? $_SESSION['error']['diachi'] : '';

    $data['remember']['idnv'] = $result['idnv'];
    $data['remember']['hoten'] = $result['hoten'];
    $data['remember']['idpb'] = $result['idpb'];
    $data['remember']['diachi'] = $result['diachi'];

    $phongban_model = new phongban_model();
    $result = $phongban_model->get('idpb, mota');
    while ($row = $result->fetch_assoc()) {
      $data['list_phongban'][] = $row;
    }

    session_destroy();

    $this->setProperty('data', $data);
    $this->view();
  }

  public function update() {
    if($_SERVER['REQUEST_METHOD'] == 'GET') { die('302'); }
    $this->loginMiddleware();

    $idnv = isset($_POST['idnv']) ? $_POST['idnv'] : '';
    $old_idnv = isset($_POST['old_idnv']) ? $_POST['old_idnv'] : '';
    $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '';
    $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';
    $phongban = isset($_POST['phongban']) ? $_POST['phongban'] : '';

    $model = new nhanvien_model();
    $result = $model->update($old_idnv, [
      'idnv' => $idnv,
      'hoten' => $hoten,
      'diachi' => $diachi,
      'idpb' => $phongban
    ]);

    if ($result) {
      header('Location: ' . vendor_url_util::makeURL(['action' => 'index']));
    } else {
      header('Location: ' . vendor_url_util::makeURL(['action' => 'edit', 'params' => ['idnv' => $old_idnv]]));
    }
  }

  public function destroy() {
    $idnv = isset($_GET['idnv']) ? $_GET['idnv'] : null;
    if(!$idnv) die();

    (new nhanvien_model())->destroy(['idnv' => $idnv]);
    header('Location: ' . vendor_url_util::makeURL(['action' => 'index']));
  }
}