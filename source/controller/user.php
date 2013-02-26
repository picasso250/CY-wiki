<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class UserController extends BasicController 
{
    public function not_taken()
    {
        $email = _req('email');
        echo User::has($email) ? 'false' : 'true';
    }

    public function __call($a, $args)
    {
        if (is_numeric($a)) {
            $user = new User($a);
        } else {
            $user = User::hasName($a);
        }
        render_view('master', compact('user'));
    }
}
