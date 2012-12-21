<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class BigCategory extends TopClass
{
    public static $table = 'big_category';

    public function subCount()
    {
        return Pdb::count(Category::table(), array('big_category = ?' => $this->id));
    }

    public function typeCount()
    {
        return Pdb::count(Type::table(), array('big_category = ?' => $this->id));
    }
}
