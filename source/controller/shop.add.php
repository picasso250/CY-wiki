<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$name = _post('name');
$district = _post('district');
$category = _post('category');
$type = _post('type');
$average = _post('average');
$address = _post('address');
$phone = _post('phone');
$latilongi = _post('latilongi');

$shop = Shop::add(compact(
    'name',
    'district',
    'category',
    'type',
    'average',
    'address',
    'phone',
    'latilongi'));

redirect("$controller/?name=$name");
