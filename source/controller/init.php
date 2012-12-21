<?php

function user_init()
{
    // db config
    $db_config = $GLOBALS['config']['db'];
    Pdb::setConfig($db_config);

    // login
    $GLOBALS['user'] = $user = User::current();
    $GLOBALS['has_login'] = $user !== false;

    $controller = $GLOBALS['controller'];
    $need_login = in_array($controller, $GLOBALS['config']['page_need_login']);
    if ($need_login && !$user) {
        if (!$by_ajax) {
            $cur_url = reset(explode('?', $_SERVER['REQUEST_URI']));
            redirect('login?back=' . $cur_url);
        } else {
            output_error(403, 'you need to login');
        }
    }

    // auto include if there exists css file same name with controller
    if (!$GLOBALS['by_ajax'] && file_exists(AppFile::css($controller)))
        add_styles($controller);

    $GLOBALS['nav'] = build_nav($GLOBALS['config']['nav']);
}
