<?php

class BasicController {
    public function __construct()
    {
        // db config
        $db_config = $GLOBALS['config']['db'];
        Sdb::setConfig($db_config);

        // login
        $GLOBALS['user'] = $user = User::current();
        $GLOBALS['has_login'] = ($user !== false);

        $controller = $GLOBALS['controller'];
        $need_login = in_array($controller, $GLOBALS['config']['page_need_login']);
        if ($need_login && !$user) {
            if (!$by_ajax) {
                $cur_url = urlencode($_SERVER['REQUEST_URI']);
                redirect('login?back=' . $cur_url);
            } else {
                output_error(403, 'you need to login');
            }
        }
        $GLOBALS['nav'] = build_nav($GLOBALS['config']['nav']);
    }
}
