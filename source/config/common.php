<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION'); // in fact, even if this is exucted by user, would it show anything?
/**
 * @file    common
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

define('PRD', 0);
define('DEBUG', 1);

if (isset($_SERVER['HTTP_APPNAME'])) { // on sae
    define('ON_SAE', TRUE);
    define('UP_DOMAIN', 'xxx');
} else {
    define('ON_SAE', FALSE);
}

define('ROOT', '/'); // 这个东西，尤其可恶，实在不觉得有存在的必要。。

$config['db'] = array(
    'host' => 'localhost',
    'dbname' => 'cywiki',
    'username' => 'root',
    'password' => 'root'
);

if (ON_SAE) {
    // 会覆盖之前的配置
    $config['db'] = array(
        'master' => array('host' => SAE_MYSQL_HOST_M),
        'slave'  => array('host' => SAE_MYSQL_HOST_S),
        'port'   => SAE_MYSQL_PORT,
        'dbname' => SAE_MYSQL_DB,
        'username' => SAE_MYSQL_USER,
        'password' => SAE_MYSQL_PASS
    );
}

if (ON_SAE || PRD) {
    include 'server.php';
} else {
    define('JS_VER',  time());
    define('CSS_VER', time());
}

include 'content.php';
