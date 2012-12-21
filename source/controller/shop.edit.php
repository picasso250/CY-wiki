<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$id = _req('target');

$name = _post('name');
$district = _post('district');
$category = _post('category');
$type = _post('type');
$average = _post('average');
$address = _post('address');
$phone = _post('phone');
$latilongi = _post('latilongi');

$shop = new Shop($id);
$shop->update(compact(
    'name',
    'district',
    'category',
    'type',
    'average',
    'address',
    'phone',
    'latilongi'));

redirect("$controller/$shop->id");
