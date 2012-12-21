<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$provinceId = _req('provinceId');

$conds = array();
if ($provinceId)
	$conds['provinceId'] = $provinceId;

$data = City::jsonData($conds);

output_data($data);
