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

    public static function create($info)
    {
        $user = g('user');
        $entryInfo = array(
            'creator' => $user,
            'created = NOW()'
        );
        $entry = parent::create($entryInfo);

        $versionInfo = array(
            'editor' => $user,
            'entry' => $entry,
            'content' => $info['content'],
        );
        $version = Version::create($versionInfo);

        $entry->update(array(
            'latest' => $version,
            'updated = NOW()'));

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
