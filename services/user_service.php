<?php session_start();

class user_service {
  private $rules = [
    'fullname' => 'required|regex:/[^a-zA-Z ]+/',
    'date_of_birth' => 'date',
    'email' => 'required|email',
    'phone' => 'number|max:11',
    'address' => 'regex:/[^a-zA-Z0-9]+/',
    'identity_card' => 'required|number|max:9|min:9',
    'gender' => 'required|in:0,1'
  ];

  public function getInfoUser($id) {
    $model = new user_model();
    $data = [];

    $result = $model->get('*', [
      'conditions' => [
        'id_user' => $id
      ]
    ])->fetch_assoc();

    $data = [
      'id' => $result['id_user'],
      'fullname' => $result['fullname'],
      'date_of_birth' => explode(' ', $result['date_of_birth'])[0], // NOTE: Get only date not time
      'email' => $result['email'],
      'address' => $result['address'],
      'identity_card' => $result['identity_card'],
      'gender' => $result['gender'],
      'phone' => $result['phone']
    ];

    return $data;
  }

  public function isCurrentUserUpdate($id) {
    if (isset($_SESSION['user_info'])) { return $_SESSION['user_info']['id'] == $id; }
    return json_decode($_COOKIE['user_info'])->id == $id;
  }

  private function validateUpdate($data) {
    $validator = new vendor_validator_util();
    $result = $validator->validate($this->rules, $data);
    if ($result['status'] == true) return true;

    foreach ($result['message'] as $key => $value) { $_SESSION['error'][$key] = $value; }
    return false;
  }

  public function update($id, $data) {
    if ($this->isCurrentUserUpdate($id) == false) die('402');
    if ($this->validateUpdate($data) == false) {
      foreach ($data as $key => $value) { $_SESSION['remember'][$key] = $value; }
      $_SESSION['remember']['id'] = $id;
      return false;
    }

    $model = new user_model();
    $model->update(['id_user' => $id], $data);
    return true;
  }
}