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
}