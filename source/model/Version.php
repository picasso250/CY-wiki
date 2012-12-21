<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class Version extends BasicModel
{
    public static function create(User $u, Entry $e, $content)
    {
        return parent::create(array(
            'entry' => $e->id,
            'editor' => $u->id,
            'text' => $content,
            'edited = NOW()' => null));
    }
}
