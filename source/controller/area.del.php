<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$id = _req('id');

require AppFile::controller($controller . '.redirect');

$o = new $target($id);
$o->del();

redirect($url);
