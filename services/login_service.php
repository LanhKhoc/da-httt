<?php session_start();

class login_service {
  public function validate($username, $password) {
    if (!$username) { $_SESSION['error']['username'] = 'Vui lòng nhập tên đăng nhập!'; return false; }
    if (!$password) { $_SESSION['error']['password'] = 'Vui lòng nhập mật khẩu!'; return false; }
    return true;
  }

  public function checkLogin($username, $password, $remember) {
    $validate = $this->validate($username, $password);
    if ($validate === false) {
      $_SESSION['remember']['username'] = $username;
      return ['status' => false];
    }

    $model = new user_model();
    $result = $model->get("*", [
      "conditions" => [
        "user_name" => $username,
      ]
    ]);
    $data = $result->fetch_assoc();

    $_SESSION['remember']['username'] = $username;
    if ($result->num_rows == 0) { $_SESSION['error']['username'] = 'Tên đăng nhập không đúng!'; return ['status' => false]; }
    if (md5($password) != $data['password']) { $_SESSION['error']['password'] = 'Mật khẩu không đúng!'; return ['status' => false]; }
    unset($_SESSION['remember']);

    $user_info = [
      'id' => $data['id_user'],
      'username' => $username,
      'fullname' => $data['fullname']
    ];

    if ($remember) {
      // NOTE: 86400 = 1 day
      setcookie('user_token', md5($username . md5($password)), time() + (86400 * 30), '/');
      setcookie('user_info', json_encode($user_info), time() + (86400 * 30), '/');
    } else {
      $_SESSION['user_info'] = $user_info;
    }

    return ['status' => true, 'user_info' => $user_info];
  }
}