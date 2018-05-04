<?php if (!defined('APPLICATION')) die ('Bad requested!');

class nhanvien_model extends vendor_model {
  protected $table = "NHANVIEN";

  public function  __construct() {
    parent::__construct();
  }

  public function validateStore($options) {
    $fKey = array_keys($options)[0];
    $fValue = array_shift($options);

    if (!$fValue) { $_SESSION['error'][$fKey] = "Không được để trống trường này"; return true; }
    foreach ($options as $key => $value) {
      if (!$value) { $_SESSION['error'][$key] = "Không được để trống trường này"; return true; }
    }

    $result = $this->get('idnv', [
      'conditions' => [
        $fKey => $fValue
      ]
    ])->num_rows;

    if($result > 0) { $_SESSION['error'][$fKey] = 'Đã tồn tại!'; return true; }

    return false;
  }

  public function validateUpdate($idnv, $options) {
    $fKey = array_keys($options)[0];
    $fValue = array_shift($options);

    foreach($options as $key => $value) {
      if(!$value) { $_SESSION['error'][$key] = "Không được để trống trường này!"; return true; }
    }

    if($idnv != $fValue) {
      $result = $this->get('idnv', [
        'conditions' => ['idnv' => $fValue]
      ])->num_rows;

      if($result > 0) { $_SESSION['error']['idnv'] = "Đã tồn tại!"; return true; }
    }

    return false;
  }

  public function store($options) {
    if ($this->validateStore($options)) return false;

    return parent::store($options);
  }

  public function search($type, $search) {
    return parent::search('*', [
      'conditions' => [$type => '%' . $search . '%'],
      'relations' => [
        'inner join' => [
          'table' => 'PHONGBAN',
          'conditions' => '`PHONGBAN`.idpb = `NHANVIEN`.idpb'
        ]
      ]
    ]);
  }

  public function update($idnv, $options) {
    if ($this->validateUpdate($idnv, $options)) return false;

    return parent::update(['idnv' => $idnv], $options);
  }
}