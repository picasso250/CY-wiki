<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class EditController extends BasicController {
    public function __construct()
    {
        parent::__construct();
        
        $id = _req('id');
        if (!$id) {
            redirect();
        }
        $entry = new Entry($id);

        if ($GLOBALS['by_post']) {
            $info = array(
                'title' => _post('title'),
                'content' => _post('content'),
                'reason' => _post('reason'),
                'category_name' => _post('category_name'),
            );
            $entry->edit($info);
            redirect("wiki/".$entry->latestVersion()->title);
        } else {
            $title = $entry->latestVersion()->title;
            $content = $entry->latestVersion()->content;
            $category_name = $entry->category ? $entry->category()->name : '';
            add_scripts(array('preview'));
            render_view('master', compact('entry', 'title', 'content', 'category_name'));
        }
    }
}
