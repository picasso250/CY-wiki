<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$cityId = _req('city');
$isSearch = _req('isSearch');

if ($by_ajax) {
    $districts = District::readArray(new City($cityId));
    $opts = array(
        'data' => $districts,
        'defaultText' => '请选择',
        'withShell' => false);
    if ($isSearch) {
        $opts['defaultText'] = '全部';
    }
    widget('select', $opts);
}
