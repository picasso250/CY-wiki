<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$id = _req('id');
$name = _req('name');
$index = _req('index');

$o = new $target($id);

$part = _req('part');
$o->update(array('`index`' => $index, 'name' => $name));

require AppFile::controller($controller . '.redirect');

redirect($url);
