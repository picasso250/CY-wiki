<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class ListController {
    public function __construct()
    {
        $entries = Entry::read();
        render_view('master', compact('entries'));
    }
}
