<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$provinceId = _req('province');

if ($by_ajax) {
    $cities = City::readArray(new Province($provinceId));
    widget(
        'select', 
        array(
            'data' => $cities,
            'defaultText' => '请选择',
            'withShell' => false));
}
