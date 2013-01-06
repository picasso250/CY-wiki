<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class PreviewController extends BasicController {
    public function __construct()
    {
        $content = _post('content');
        echo '<div class="wiki-content">', markdown_parse($content), '</div>';
    }
}
