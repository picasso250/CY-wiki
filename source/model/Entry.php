<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class Entry extends BasicModel
{
    public static $relationMap = array(
        'creator' => 'user',
        'latest' => 'version',
    );

    public function urlTitle()
    {
        $urlTitle = urlencode($this->latestVersion()->title);
        return $urlTitle;
    }

    public static function has($title)
    {
        $entries = static::search()->by('latest.title', $title)->find(1);
        return $entries ? $entries[0] : false;
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

    public function edit($info)
    {
        $user = g('user');
        $versionInfo = array(
            'editor' => $user,
            'title' => $info['title'],
            'content' => $info['content'],
            'reason' => $info['reason']
        );
        $version = Version::create($versionInfo);
        if ($info['category_name']) {
            $category = Category::search()->by('name', $info['category_name'])->find(1);
            if ($category) {
                $category = $category[0];
            } else {
                $category = Category::create(array('name' => $info['category_name']));
            }
        } else {
            $category = 0;
        }
        parent::update(array(
            'latest' => $version->id, 
            'title' => $title,
            'category' => $category,
            'updated = NOW()' => null,
        ));
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
