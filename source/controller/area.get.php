<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$provinceId = _get('province');
$cityId = _get('city');

$provinces = Province::read();

if ($provinceId) {
    $cur_province = new Province($provinceId);
    $cities = City::read($cur_province);
}

if ($cityId) {
    $cur_city = new City($cityId);
    $districts = District::read($cur_city);
}

render_view('master', array('view' => 'backend'));
