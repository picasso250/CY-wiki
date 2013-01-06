<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class CreateController extends BasicController {
    public function __construct()
    {
        parent::__construct();
        if ($GLOBALS['by_post']) {
            $title = _post('title');
            $content = _post('content');
            $reason = _post('reason');

            if ($title) {
                $GLOBALS['user']->createEntry($title, $content);
                redirect("wiki/$title");
            }
        }
        add_scripts('preview');
        render_view('master');
    }
}
