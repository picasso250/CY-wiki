<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$paragraphs = explode(PHP_EOL, $config['help_text']);
render_view('master', array('view' => 'help'));
