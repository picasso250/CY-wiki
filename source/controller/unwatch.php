<?php

class UnwatchController extends BasicController 
{
    public function __call($id, $args)
    {
        if (!$GLOBALS['has_login'])
            redirect();
        $entry = new Entry($id);
        Watch::cancel($GLOBALS['user'], $entry);
        redirect("wiki/$entry->title");
    }
}
