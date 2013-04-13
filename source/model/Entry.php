<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class Entry extends BasicModel
{
    public static $relationMap = array('creator' => 'user');

    public function urlTitle()
    {
        $urlTitle = urlencode($this->title);
        return $urlTitle;
    }

    public static function has($title)
    {
        $info = Sdb::fetchRow('*', self::table(), array('title = ?' => $title));
        return $info ? new self($info) : false;
    }

    public function versions()
    {
        return Version::search()->by('entry', $this)->sort('id DESC')->find();
    }
    
    public function latestVersion()
    {
        return new Version($this->latest);
    }

    public static function create(User $user, $title, $content)
    {
        $entry = parent::create(array(
            'title' => $title,
            'creator' => $user->id,
            'created = NOW()' => null));

        $version = Version::create($user, $entry, $content);

        $entry->update(array(
            'latest' => $version->id,
            'updated = NOW()' => null));

        return $entry;
    }

    public static function recents($num = 10)
    {
        return self::search()->limit($num)->sort('updated DESC')->find();
    }

    public function edit(User $user, $title, $content, $reason)
    {
        $version = Version::create($user, $this, $content, $reason);
        parent::update(array(
            'latest' => $version->id, 
            'title' => $title,
            'updated = NOW()' => null));
    }

    public static function buildDbArgs($conds)
    {
        $tables = self::table();
        extract($conds);
        $conds = array();
        $orderby = array();
        $tail = '';
        if (isset($limit))
            $tail .= "LIMIT $limit";
        if (isset($sort))
            $orderby[] = $sort;
        return array($tables, $conds, $orderby, $tail);
    }
}
