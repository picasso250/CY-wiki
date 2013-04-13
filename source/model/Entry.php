<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class Entry extends BasicModel
{
    public static $relationMap = array('creator' => 'user');

    public function urlTitle()
    {
        $urlTitle = urlencode($this->latestVersion()->title);
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
            // 'created = NOW()'
        );
        $entry = parent::create($entryInfo);

        $versionInfo = array(
            'editor' => $user,
            'entry' => $entry,
            'title' => $info['title'],
            'content' => $info['content'],
        );
        $version = Version::create($versionInfo);

        $entry->update(array(
            'latest' => $version,
            'updated = NOW()'));

        if (isset($info['category_name']) && $info['category_name']) {
            $category = Category::search()->by('name', $info['category_name'])->find(1);
            if ($category) {
                $category = $category[0];
            } else {
                $category = Category::create(array('name' => $info['category_name']));
            }
            $entry->update('category', $category);
        }

        return $entry;
    }

    public static function recents($num = 10)
    {
        return self::search()->limit($num)->sort('updated DESC')->find();
    }

    public function edit(User $user, $title, $content, $reason)
    {
        $versionInfo = array(
            'editor' => $user,
            'title' => $title,
            'content' => $content,
            'reason' => $reason
        );
        $version = Version::create($versionInfo);
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
