<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$id = _req('id');
$name = _req('name');

$o = new $target($id);
$o->update(compact('name'));

redirect("cate/$target");
