<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

if ($has_login) {
    $user->logout();
}

redirect();
