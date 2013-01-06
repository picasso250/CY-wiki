<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class EditController extends BasicController {
    public function __construct()
    {
        parent::__construct();
        
        $id = _req('id');
        $entry = new Entry($id);

        if ($GLOBALS['by_post']) {
            $title = _post('title');
            $content = _post('content');
            $reason = _post('reason');

            $entry->edit($GLOBALS['user'], $title, $content, $reason);
            redirect("wiki/$title");
        } else {
            $title = $entry->title;
            $content = $entry->latestVersion()->content;
            add_scripts(array('preview'));
            render_view('master', compact('entry', 'title', 'content'));
        }
    }
}
