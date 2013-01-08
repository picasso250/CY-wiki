<?php

class MywikiController extends BasicController 
{
    public function __construct()
    {
        parent::__construct();

        if (!$GLOBALS['has_login'])
            return;
        $user = $GLOBALS['user'];
        $createdEntries = $user->createdEntries();
        $editedEntries = $user->editedEntries();
    }
}
