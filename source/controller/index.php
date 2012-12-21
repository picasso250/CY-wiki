<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class IndexController {
    public function __construct()
    {
        if (!$GLOBALS['target'])
            render_view('master', array('view' => 'index'));
    }
}
