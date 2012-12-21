<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class User extends BasicModel
{
    public static function add($username, $password)
    {
        $arr = array(
            'name' => $username,
            'password' => md5($password));
        Pdb::insert($arr, self::table());
        return new self(Pdb::lastInsertId());
    }

    public function find($username)
    {
        return Pdb::exists(self::table(), array('name=?' => $username));
    }

    public static function check($username, $password)
    {
        $info = Pdb::fetchRow('*', self::table(), array(
            'name=?' => $username,
            'password=?' => md5($password)));
        if ($info) {
            return new User($info);
        } else {
            return false;
        }
    }

    public function changePassword($new_password)
    {
        Pdb::update(
            array('password' => md5($new_password)),
            self::table(),
            $this->selfCond());
    }

    public function login()
    {
        $_SESSION['se_user_id'] = $this->id;
        $this->update(array('updated = NOW()' => null));
    }

    public function logout()
    {
        $_SESSION['se_user_id'] = 0;
    }

    public static function loggedIn()
    {
        if (isset($_SESSION['se_user_id']) && $_SESSION['se_user_id']) {
            return new self($_SESSION['se_user_id']);
        } else {
            return false;
        }
    }
}
