<?php

$tables = array(
    'user',
    'entry', 
    'version');
foreach ($tables as $t) {
    Pdb::exec("TRUNCATE TABLE $t"); // but why here??? Province::$table not work?
}

if (_get('exit')) {
    echo '<script src="static/hide.js"></script>';
    echo '<div class="conclusion pass">All Clear!</div>';
    exit;
}
