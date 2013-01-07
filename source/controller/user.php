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

    public function __call($name, $args)
    {
        $u = User::hasName($name);
        render_view('master', compact('u'));
    }
}
