<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class IndexController {
    public function __construct()
    {
        $recents = Entry::recents(10);
        render_view('master', compact('recents'));
    }
}
