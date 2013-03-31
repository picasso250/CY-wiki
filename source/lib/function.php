<?php
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

function markdown_parse($content)
{
    require_once AppFile::lib('markdown' . DS . 'markdown');
    return Markdown(parse_inner_link($content));
}

function parse_inner_link($str)
{
    return preg_replace('/\[(.+?)\](?!\()/', '[$1]($1)', $str);
}

function diff_old($from, $to)
{
    $from = mb_convert_encoding($from, 'HTML-ENTITIES', 'UTF-8');
    $to = mb_convert_encoding($to, 'HTML-ENTITIES', 'UTF-8');

    require_once AppFile::lib('finediff');
    $diff = new FineDiff($from, $to, FineDiff::$paragraphGranularity);
    $html = $diff->renderDiffToHTML();

    $html = mb_convert_encoding($html, 'UTF-8', 'HTML-ENTITIES');
    $html = html_entity_decode($html);
    $html = nl2br($html);

    return $html;
}


// get all sub strings for a given string
// return an array whose count is O(n^2)
function all_substr($str)
{
    $length = strlen($str);
    $ret = array();
    for ($i=0; $i < $length; $i++) {
        $max_length = $length - $i;
        for ($j=1; $j <= $max_length; $j++) {
            $ret[] = substr($str, $i, $j);
        }
    }
    return $ret;
}
 
// get all common sub strings for two given string
// O(n^4)
function common_substrs($a, $b)
{
    $ret = array();
    $as = all_substr($a);
    foreach ($as as $s) { // O(n^2)
        $pos = strpos($b, $s); // O(m*n)
        if ($pos !== false) {
            $ret[] = $s;
        }
    }
    return $ret;
}
 
// great common sub string
function gcstr($a, $b)
{
    $all = common_substrs($a, $b);
    $max_len = 0;
    $g = '';
    foreach ($all as $s) {
        $len = strlen($s);
        if ($len > $max_len) {
            $max_len = $len;
            $g = $s;
        }
    }
    return $g;
}
 
function diff_word($a, $b)
{
    $cs = gcstr($a, $b);
    if (empty($cs)) {
        return array(
            '-' => $a,
            '+' => $b,
        );
    }
    $cslen = strlen($cs);
    $ap = strpos($a, $cs);
    $bp = strpos($b, $cs);
    $la = substr($a, 0, $ap);
    $lb = substr($b, 0, $bp);
    $ra = substr($a, $ap+$cslen);
    $rb = substr($b, $bp+$cslen);
    return array(diff_word($la, $lb), $cs, diff($ra, $rb));
}




// O(n^4)
function great_common_sub($a, $b)
{
    if (!$a || !$b) {
        return false;
    }
    $max_len = 0;
    foreach ($a as $ka => $ea) {
        foreach ($b as $kb => $eb) {
            if (trim($ea) == trim($eb)) {
                $kka = $ka+1;
                $kkb = $kb+1;
                while (isset($a[$kka]) && isset($b[$kkb]) && trim($a[$kka]) == trim($b[$kkb])) {
                    $kka++;
                    $kkb++;
                }
                $len = $kka - $ka;
                if ($max_len < $len) {
                    $max_len = $len;
                    $finda = $ka;
                    $findb = $kb;
                }
            }
        }
    }
    if ($max_len) {
        return array(
            'starta' => $finda,
            'startb' => $findb,
            'length' => $max_len,
        );
    }
    return false;
}
 
function _diff_line($a, $b, &$arr)
{
    $cs = great_common_sub($a, $b);
    if (empty($cs)) {
        if ($a) {
            $arr[] = array('-' => $a);
        }
        if ($b) {
            $arr[] = array('+' => $b);
        }
        return;
    }
    $cslen = $cs['length'];
    $ap = $cs['starta'];
    $bp = $cs['startb'];
    $la = array_slice($a, 0, $ap);
    $lb = array_slice($b, 0, $bp);
    $ra = array_slice($a, $ap+$cslen);
    $rb = array_slice($b, $bp+$cslen);
    if ($l = _diff_line($la, $lb, $arr)) {
        $arr = array_merge($arr, $l);
    }
    if ($cslen) {
        $arr = array_merge($arr, array_slice($a, $ap, $cslen));
    }
    if ($r = _diff_line($ra, $rb, $arr)) {
        $arr = array_merge($arr, $r);
    }
    return;
}

function diff_line($a, $b)
{
    $arr = array();
    _diff_line($a, $b, $arr);
    return $arr;
}
