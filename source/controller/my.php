<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class MyController {
    public function __construct()
    {
        $user = $GLOBALS['user'];

        if ($action === 'edit') {
            $name = _post('name');
            if ($name) {
                $user->update(compact('name'));
            }

            $newPass = _post('newPass');
            if ($newPass && $user->checkPassword(_post('oldPass'))) {
                $user->changePassword($newPass);
            }
        }
        render_view('master', compact('user'));
    }
}
