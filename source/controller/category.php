<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$bigCategoryId = _req('bigCategory');

if ($by_ajax) {
    $categories = Category::readArray(new BigCategory($bigCategoryId));
    widget(
        'select', 
        array(
            'data' => $categories,
            'defaultText' => '请选择',
            'withShell' => false));
}
