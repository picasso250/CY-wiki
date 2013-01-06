<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class Version extends BasicModel
{
    public static function create(User $u, Entry $e, $content, $reason = '')
    {
        return parent::create(array(
            'entry' => $e->id,
            'editor' => $u->id,
            'content' => $content,
            'reason' => $reason,
            'edited = NOW()' => null));
    }

    public function toHtml()
    {
        return markdown_parse($this->content);
    }

    public function editor()
    {
        return new User($this->editor);
    }
}
