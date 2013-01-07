<?php

class LoginController extends BasicController 
{
    public function __construct()
    {
        parent::__construct();
        
        $username = _post('username');
        $password = _post('password');

        $msg = '';
        if ($username && $password) {
            $user = User::check($username, $password);
            if ($user) {
                $user->login();
                redirect(_req('back'));
            } else {
                $msg = $GLOBALS['config']['error']['info']['USERNAME_OR_PASSWORD_INCORRECT'];
            }
        }

        add_scripts('jquery.validate.min');
        render_view('master', compact('username', 'msg'));
    }
}
