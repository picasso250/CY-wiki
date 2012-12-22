<?php
!(defined('IN_APP') && defined('ON_TEST')) && exit('ILLEGAL EXECUTION');

$dbConfig = array_merge($config['db'], array('force' => 'master'));
Pdb::setConfig($dbConfig);

// clear side effects for all
// unset all session
if (1) {
    foreach ($_SESSION as $key => $value) {
        unset($_SESSION[$key]);
    }
}

// clear db entries that was insert by test
include 'clear_db.php';

$all_pass = true;

require CORE_ROOT . 'BasicModel.php';
$user_lib_file = APP_ROOT . 'lib' . DS . 'function.php';
if (file_exists($user_lib_file))
    require_once $user_lib_file;

// test for user

begin_test();
$email = 'test@z.cn';
$user = User::create($email, 'password');
$user->update('name', '小池');
test($user->email, $email, 'create User');

begin_test();
$title = 'hello';
$user->createEntry($title, 'word');
test(Entry::count(), 1, 'create Entry');

begin_test();
test(!Entry::has($title), false, 'has Entry?');

begin_test();
$origin = '
foo [bar]zz [apple]
[link](baidu.com)
z[baz]. Se[what]
';
$dst = '
foo [bar](bar)zz [apple](apple)
[link](baidu.com)
z[baz](baz). Se[what](what)
';
test(parse_inner_link($origin), $dst, 'parse inner link');
