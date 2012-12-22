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
        require_once AppFile::lib('markdown' . DS . 'markdown');
        return Markdown(self::parse($this->content));
    }

    public static function parse($str)
    {
        return preg_replace('/\[(.+?)\](?!\()/', '[$1]($1)', $str);
    }
}
