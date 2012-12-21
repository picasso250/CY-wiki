<?php
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

function output_data($data, $opts = array())
{
    output_json(array('data' => $data));
}

function output_error($code, $a = null)
{
    $msg = 'error';
    if ($a === null) {
        $error = array('message' => $msg);
    } elseif (is_string($a)) {
        $msg = $a;
        $error = array('message' => $msg);
    } elseif (is_array($a)) {
        if (isset($a['message']))
            $msg = $a['message'];
        $error = $a;
    } else {
        throw new Exception("bad arg: $a");
    }

    header("HTTP/1.1 $code $msg");
    $error['code'] = $code;
    output_json(array('error' => $error));
}

function output_json($arr)
{
    $arr['apiVersion'] = '1.0';
    header('Content-Type:application/json');
    echo json_encode($arr);
    exit;
}

function break_latilongi($latilongi)
{
    if (preg_match('/^([\+|-]?\d+\.\d+),?([\+|-]?\d+\.\d+)$/', $latilongi, $matches)) {
        return array($matches[1], $matches[2]);
    } else {
        throw new Exception("latilongi not right: $latilongi");
    }
}
