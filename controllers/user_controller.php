<?php session_start();

class user_controller extends vendor_controller {
    public function loginMiddleware() {
        return isset ($_SESSION['user_info']);
    }

    public function index() {
        if ($this->loginMiddleware() === false) {
            header('Location: ' . vendor_url_util::makeURL(['controller' => 'login']));
        }

        $data = $_SESSION['user_info'];

        $this->setProperty('data', $data);
        $this->view();
    }
}

?>