<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$id = _req('id');

$shop = new Shop($id);
$shop->del();

redirect($controller);
