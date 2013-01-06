<?php

class RegisterController extends BasicController {
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

        add_scripts('jquery.validate.min');
        render_view('master', compact('email'));
    }
}
