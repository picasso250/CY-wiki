<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

BigCategory::add($name);

redirect("cate/$target");
