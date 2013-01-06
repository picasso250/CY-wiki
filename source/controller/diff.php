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

        $versions = $entry->versions();
        $rightVer = $versions[0];
        if (isset($versions[1])) {
            $leftVer = $versions[1];
        }

        // $rightHtml = diff($leftVer->content, $rightVer->content);
        $rightHtml = nl2br($rightVer->content);

        render_view('master', compact('entry', 'leftVer', 'rightVer', 'rightHtml'));
    }
}
