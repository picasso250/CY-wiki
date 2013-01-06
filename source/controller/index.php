<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class IndexController extends BasicController {
    public function __construct()
    {
        parent::__construct();
        $recents = Entry::recents(10);
        render_view('master', compact('recents'));
    }
}
