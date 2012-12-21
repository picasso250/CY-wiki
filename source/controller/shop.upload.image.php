<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$id = _req('shop');

$src = make_image($_FILES['image']);

$shop = new Shop($id);
$shop->addImage($src);

redirect("$controller/$id");
