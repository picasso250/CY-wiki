<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

class LogoutController {
    public function __construct()
    {
        if ($GLOBALS['has_login']) {
            $GLOBALS['user']->logout();
        }

        redirect();
    }
}
