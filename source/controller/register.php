<?php

class RegisterController {
    public function __construct()
    {
        $email = _post('email');
        $password = _post('password');

        if ($email && $password) {
            $user = User::create($email, $password);
            if ($user) {
                $user->update('name', $email);
                $user->login();
                redirect('my');
            }
        }

        render_view('master', compact('email'));
    }
}
