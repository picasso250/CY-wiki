<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class ListController extends BasicController {
    public function __construct()
    {
        parent::__construct();
        $entries = Entry::search()->find();
        render_view('master', compact('entries'));
    }
}
