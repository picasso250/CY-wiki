<?php

class LoginController {
    public function __construct()
    {
        $username = _post('username');
        $password = _post('password');

        if ($username && $password) {
            $user = User::check($username, $password);
            if ($user) {
                $user->login();
                redirect(_req('back'));
            }
        }

        render_view('master', compact('username'));
    }
}
