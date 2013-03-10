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

        $rightHtml = nl2br($rightVer->content);

        $rightContent = $rightVer->content;
        $leftContent = $leftVer->content;

        $la = explode("\n", $leftContent);
        $ra = explode("\n", $rightContent);
        $dl = array_diff($la, $ra);
        $dr = array_diff($ra, $la);
        d($dl);
        d($dr);
        $leftHtml = '';

        render_view('master', compact('entry', 'r', 'l', 'id', 'versionCount', 'leftVer', 'rightVer', 'rightHtml'));
    }
}
