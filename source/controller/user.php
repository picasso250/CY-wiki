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
}
