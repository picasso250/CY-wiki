<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class Entry extends BasicModel
{
    public static function has($title)
    {
        $info = Pdb::fetchRow('*', self::table(), array('title = ?' => $title));
        return $info ? new self($info) : false;
    }
    
    public function latestVersion()
    {
        return new Version($this->latest);
    }

    public static function create(User $user, $title, $content)
    {
        $entry = parent::create(array(
            'title' => $title, 
            'created = NOW()' => null));

        $version = Version::create($user, $entry, $content);

        $entry->update('latest', $version->id);

        return $entry;
    }

    public function edit(User $user, $title, $content, $reason)
    {
        $version = Version::create($user, $this, $content, $reason);
        parent::update(array('latest' => $version->id, 'title' => $title));
    }
}
