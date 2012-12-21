<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$url = $controller;
switch ($target) {
    case 'Province':
        break;

    case 'City':
        $c = new City($id);
        $pid = $c->province()->id;
        $url .= '?province=' . $pid;
        break;

    case 'District':
        $d = new District($id);
        $c = $d->city();
        $p = $c->province();
        $url .= "?province=$p->id&city=$c->id";
        break;
    
    default:
        throw new Exception("unknown target: $target", 1);
        break;
}
