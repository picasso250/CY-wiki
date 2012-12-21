<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$id = _req('id');

$image = new Image($id);
$shopId = $image->shop;
$image->del();

redirect("$controller/$shopId");
