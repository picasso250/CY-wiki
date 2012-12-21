<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class ListController {
    public function __construct()
    {
        if ($GLOBALS['by_post']) {
            $title = _post('title');
            $content = _post('content');
            $reason = _post('reason');

            $GLOBALS['user']->createEntry($title, $content);
            redirect();
        }
        render_view('master');
    }
}
