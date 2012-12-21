<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$bigCategories = BigCategory::readArray();

foreach ($bigCategories as $id => $name) {
    $bigCate = new BigCategory($id);
    $associateCategories[$id] = Category::readArray($bigCate);
}

render_view('master', array('view' => 'backend'));
