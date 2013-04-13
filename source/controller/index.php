<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class IndexController extends BasicController {
    public function __construct()
    {
        parent::__construct();


        $versions = Version::search()->find();
        foreach ($versions as $key => $v) {
            $e = $v->entry();
            if ($e->exists()) {
                $e = $e->toArray();
                if (isset($e['title'])) {
                    $v->title = $e['title'];
                }
            }
        }
        echo "ok";
        exit;
        $recents = Entry::recents(10);
        render_view('master', compact('recents'));
    }
}
