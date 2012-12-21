<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class City extends SubClass
{
    public function province()
    {
        return new Province($this->province);
    }
}
