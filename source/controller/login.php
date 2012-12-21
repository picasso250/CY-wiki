<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$username = _post('username');
$password = _post('password');

$msg = '';
if ($username && $password) {
    $ERROR = $config['error']['info'];
    $user = User::check($username, $password);
    if (!$user) {
        $msg = $ERROR['USERNAME_OR_PASSWORD_INCORRECT'];
    } else {
        $user->login();
        redirect(_req('back'));
    }
}

render_view('master', array('view' => 'login'));
