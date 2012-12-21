<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$name = _post('name');

$url = $controller;
switch ($target) {
    case 'Province':
        Province::add($name);
        break;

    case 'City':
        $pid = _post('province');
        City::add(new Province($pid), $name);
        $url .= '?province=' . $pid;
        break;

    case 'District':
        $cid = _post('city');
        $city = new City($cid);
        District::add($city, $name);
        $pid = $city->province()->id;
        $url .= "?province=$pid&city=$cid";
        break;
    
    default:
        throw new Exception("unknown target: $target", 1);
        break;
}

redirect($url);
