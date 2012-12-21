<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

if (empty($target)) {
    throw new Exception("no target");
}
if (!$by_post) {
    throw new Exception("not by post", 1);
}

$name = _post('name');

if ($target !== 'BigCategory') {
    $bcid = _post('bigCategory');
    $target::add(new BigCategory($bcid), $name);
    redirect("cate/$target");
}
