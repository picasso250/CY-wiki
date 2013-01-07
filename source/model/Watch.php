<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class Watch extends BasicModel
{
    public static function create(User $user, Entry $entry)
    {
        return parent::create(array(
            'user' => $user->id,
            'entry' => $entry->id));
    }

    public static function is(User $user, Entry $entry)
    {
        $conds = array('user' => $user->id, 'entry' => $entry->id);
        $info = Pdb::fetchRow('*', self::table(), $conds);
        return $info ? new self($info) : false;
    }

    public static function cancel(User $user, Entry $entry)
    {
        $watch = self::is($user, $entry);
        if ($watch) {
            $watch->del();
        }
    }
}
