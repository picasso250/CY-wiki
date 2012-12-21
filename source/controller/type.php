<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$bigCategoryId = _req('bigCategory');

if ($by_ajax) {
    $types = Type::readArray(new BigCategory($bigCategoryId));
    widget(
        'select', 
        array(
            'data' => $types,
            'defaultText' => '请选择',
            'withShell' => false));
}
