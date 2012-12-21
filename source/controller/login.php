<?php

class LoginController {
    public function __construct()
    {
        $username = _post('username');
        $password = _post('password');

        if ($username && $password) {
            $user = User::check($username, $password);
            if (!$user) {
                $msg = $ERROR['USERNAME_OR_PASSWORD_INCORRECT'];
            } else {
                $user->login();
                redirect(_req('back'));
            }
        }

        render_view('master', compact('username'));
    }
}
