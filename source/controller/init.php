<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

// db config
$db_config = $GLOBALS['config']['db'];
Pdb::setConfig($db_config);

// login
$user = User::loggedIn(); // but the var here should be long such as $logging_user
if ($user === false) {
    $has_login = false;
} else {
    $has_login = true;
}

$need_login = in_array($controller, $config['page_need_login']);
if ($need_login && !$has_login) {
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

$topNav = build_nav($config['nav']['top']);
$sideNav = build_nav($config['nav']['side']);
