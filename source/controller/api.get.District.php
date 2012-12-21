<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$cityId = _req('cityId');

$conds = array();
if ($cityId)
	$conds['cityId'] = $cityId;

$data = District::jsonData($conds);

output_data($data);
