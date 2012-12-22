<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class PreviewController {
    public function __construct()
    {
        $content = _post('content');
        echo markdown_parse($content);
    }
}
