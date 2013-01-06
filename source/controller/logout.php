<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

class LogoutController extends BasicController {
    public function __construct()
    {
        parent::__construct();
        
        if ($GLOBALS['has_login']) {
            $GLOBALS['user']->logout();
        }

        redirect();
    }
}
