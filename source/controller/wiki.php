<?php

class WikiController {
    public function __construct()
    {
    }

    public function __call($name, $args)
    {
        $entry = Entry::has($name);
        if ($entry) {
            // show
            render_view('master', compact('entry'));
        } else {
            redirect("create?title=$name");
        }
    }
}