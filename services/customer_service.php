<?php

class customer_service {
  public function getAll($page) {
    $model = new customer_model();
    $result = $model->pagination($page);
    $data = [];

    $data['pagination'] = [
      'page' => $page,
      'total_page' => $result['total_page'],
      'min' => $result['min'],
      'max' => $result['max']
    ];

    foreach ($result['data'] as $item) {
      $data['data'][] = [
        'id' => $item['id_client'],
        'fullname' => $item['fullname'],
        'state' => $item['active']
      ];
    }

    return $data;
  }

  public function getInfoCustomer($id) {
    $model = new customer_model();
    $data = [];

    $result = $model->get('*', [
      'conditions' => [
        'id_client' => $id
      ]
    ])->fetch_assoc();

    $data = [
      'fullname' => $result['fullname'],
      'gender' => $result['gender'] == 1 ? 'Nam' : 'Nữ',
      'date_of_birth' => $result['date_of_birth'],
      'email' => $result['email'],
      'phone' => $result['phone'],
      'address' => $result['address'],
      'state' => $result['active'] == 1 ? 'Còn hạn' : 'Hết hạn'
    ];

    return $data;
  }
}