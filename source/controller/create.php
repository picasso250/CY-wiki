<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class CreateController extends BasicController {
    public function __construct()
    {
        parent::__construct();
        if ($GLOBALS['by_post']) {
            $info = array();
            $info['title'] = _post('title');
            $info['content'] = _post('content');
            $info['reason'] = _post('reason');
            $info['category_name'] = _post('category_name');
            if ($info['title']) {
                $entry = Entry::create($info);
                redirect("wiki/$entry->title");
            }
        }
        add_scripts('preview');
        render_view('master');
    }
}
