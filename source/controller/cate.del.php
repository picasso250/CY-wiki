<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$id = _req('id');

$bc = new $target($id);
$bc->del();
