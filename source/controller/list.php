<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class ListController extends BasicController {
    public function __construct()
    {
        parent::__construct();
        $c = _get('category');
        $searcher = Entry::search();
        $category = null;
        if ($c) {
            $category = new Category($c);
            $searcher = $searcher->by('category', $category);
        }
        $entries = $searcher->find();
        render_view('master', compact('entries', 'category'));
    }
}
