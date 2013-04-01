<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class DiffController extends BasicController {
    public function __construct()
    {
        parent::__construct();
        
        $id = _req('id');
        $entry = new Entry($id);

        $r = _req('r') ?: 0;
        $l = _req('l') ?: 1;

        $versions = $entry->versions();
        $versionCount = count($versions);
        if ($versionCount < 2) {
            return;
        }

        if (isset($versions[$r]))
            $rightVer = $versions[$r];
        else 
            $rightVer = $rightVer[0];

        if (isset($versions[$l]))
            $leftVer = $versions[$l];
        else
            $leftVer = $versions[1];

        $rightContent = $rightVer->content;
        $leftContent = $leftVer->content;

        $la = explode("\n", $leftContent);
        $ra = explode("\n", $rightContent);

        list($a, $b) = diff_line($la, $ra);
        $rightHtml = $this->diffToHtml($a);
        $leftHtml = $this->linesToHtml($b);

        render_view('master', compact('entry', 'r', 'l', 'id', 'versionCount', 'leftVer', 'rightVer', 'rightHtml', 'leftHtml'));
    }

    private function diffToHtml($diffArr)
    {
        $arr = array_map(function ($line) {
            if (is_string($line)) {
                return "<p>$line</p>";
            } elseif (is_array($line)) {
                $key = key($line);
                $arr = current($line);
                $map = array(
                    '+' => 'ins',
                    '-' => 'del',
                );
                $class = $map[$key];
                $arr = array_map(function ($line) use($class) {
                    return '<p class="'.$class.'">'.$line.'</p>';
                }, $arr);
                return implode('', $arr);
            }
        }, $diffArr);
        return implode("\n", $arr);
    }

    private function linesTohtml($lines)
    {
        $arr = array_map(function ($line) {
            return "<p>$line</p>";
        }, $lines);
        return implode("\n", $arr);
    }
}
