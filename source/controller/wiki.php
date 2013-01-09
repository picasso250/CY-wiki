<?php

class WikiController extends BasicController 
{
    public function __call($name, $args)
    {
        $name = urldecode($name);
        $entry = Entry::has($name);
        if ($entry) {
            // show
            $watching = false;
            if ($GLOBALS['has_login']) {
                $watching = Watch::is($GLOBALS['user'], $entry);
            }
            render_view('master', compact('entry', 'watching'));
        } else {
            redirect("create?title=$name");
        }
    }
}
