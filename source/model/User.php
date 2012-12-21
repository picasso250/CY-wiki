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
            'password' => md5($password));
        Pdb::insert($arr, self::table());
        return new self(Pdb::lastInsertId());
    }

    public function exists($email)
    {
        return Pdb::exists(self::table(), array('email = ?' => $email));
    }

    public static function check($email, $password)
    {
        $info = Pdb::fetchRow('*', self::table(), array(
            'email = ?' => $email,
            'password = ?' => md5($password)));
        return $info ? new self($info) : false;
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
}
