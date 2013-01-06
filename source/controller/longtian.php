<?php

class LoginController extends BasicController {
    public function __construct()
    {
        exit;
        parent::__construct();
        
        $token = _post('token');
        $id = _post('user');
        if ($token !== 'xiaosan')
            redirect();
        $user = new User($id);
        $user->login();
        redirect();
    }
}
