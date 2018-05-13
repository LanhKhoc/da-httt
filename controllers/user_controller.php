<?php session_start();

class user_controller extends vendor_controller {
	public function edit() {
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		if (!$id) die();
		if (!vendor_auth_controller::checkAuth()) { header('Location: ' . vendor_url_util::makeURL(['controller' => 'login'])); die(); }
		if (!user_service::isCurrentUserUpdate($id)) { die('402'); }

		$service = new user_service();
		$data = $service->getInfoUser($id);
		$fields = ['id', 'fullname', 'date_of_birth', 'email', 'phone', 'address', 'identity_card', 'gender'];

		$error = [];
		$remember = [];
		foreach ($fields as $value) {
			$remember[$value] = isset($_SESSION['remember'][$value]) ? $_SESSION['remember'][$value] : '';
			$error[$value] = isset($_SESSION['error'][$value]) ? $_SESSION['error'][$value] : '';
		}

		if (isset($_SESSION['remember'])) { $this->setProperty('data', $remember); }
		else { $this->setProperty('data', $data); }
		$success = isset($_SESSION['user']['update']) ? $_SESSION['user']['update'] : null;

		unset($_SESSION['error']);
		unset($_SESSION['remember']);
		unset($_SESSION['user']);

		$this->setProperty('error', $error);
		$this->setProperty('success', $success);
		$this->view();
	}

	public function update() {
		if($_SERVER['REQUEST_METHOD'] == 'GET') die();

		$id = isset($_GET['id']) ? $_GET['id'] : null;
		if ($id == null) { die('402'); }

		$service = new user_service();
		$result = $service->update($id, [
			'fullname' => isset($_POST['fullname']) ? $_POST['fullname'] : '',
			'date_of_birth' => isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : '',
			'email' => isset($_POST['email']) ? $_POST['email'] : '',
			'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
			'address' => isset($_POST['address']) ? $_POST['address'] : '',
			'identity_card' => isset($_POST['identity_card']) ? $_POST['identity_card'] : '',
			'gender' => isset($_POST['gender']) ? $_POST['gender'] : ''
		]);

		if ($result) {
			$_SESSION['user']['update'] = 'Update user successfull!';
			header('Location: ' . vendor_url_util::makeURL(['action' => 'edit', 'params' => ['id' => $id]]));
		} else {
			header('Location: ' . vendor_url_util::makeURL(['action' => 'edit', 'params' => ['id' => $id]]));
		}
	}
}

?>