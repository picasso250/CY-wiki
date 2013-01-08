<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class User extends BasicModel
{
    public function createEntry($title, $content)
    {
        return Entry::create($this, $title, $content);
    }

    public static function create($email, $password)
    {
        $arr = array(
            'email' => $email,
            'password' => md5($password),
            'created=NOW()' => null);
        Pdb::insert($arr, self::table());
        return new self(Pdb::lastInsertId());
    }

    public static function has($email)
    {
        return Pdb::exists(self::table(), array('email = ?' => $email));
    }

    public static function hasName($name)
    {
        $info = Pdb::fetchRow('*', self::table(), array('name=?' => $name));
        return $info ? new self($info) : false;
    }

    public static function check($email, $password)
    {
        $info = Pdb::fetchRow('*', self::table(), array(
            'email = ?' => $email,
            'password = ?' => md5($password)));
        return $info ? new self($info) : false;
    }

    public function checkPassword($password)
    {
        return md5($password) === $this->password;
    }

    public function changePassword($new_password)
    {
        $this->update(array('password' => md5($new_password)));
    }

    public function login()
    {
        $_SESSION['se_user_id'] = $this->id;
    }

    public function logout()
    {
        $_SESSION['se_user_id'] = 0;
    }

    // get the current user who has logined in
    public static function current()
    {
        if (isset($_SESSION['se_user_id']) && $_SESSION['se_user_id']) {
            return new self($_SESSION['se_user_id']);
        } else {
            return false;
        }
    }

    public function createdEntries()
    {
        $this->updateCreatedEntries();
        return Entry::search()->filterBy('creator', $this)->orderBy('id DESC')->find();
    }

    public function editedEntries()
    {
        return Entry::search()
            ->join(Version::search()->filterBy('editor', $this))
            ->orderBy('updated DESC')
            ->distinct()
            ->find();
    }

    public function updateCreatedEntries()
    {
        $ids = Pdb::fetchAll('id', Entry::table());
        foreach ($ids as $id) {
            $v = Pdb::fetchRow('*', Version::table(), array('entry=?' => $id), array('id ASC'));
            $e = new Entry($id);
            $e->update('creator', $v['editor']);
        }
    }
}
