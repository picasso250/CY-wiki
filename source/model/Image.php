<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class Image extends BasicModel
{
    public static $table = 'shop_image';

    public static function read(Shop $shop)
    {
        return array_map(function ($info) {
            return new Image($info);
        }, Pdb::fetchAll('*', self::table(), array('shop = ?' => $shop->id)));
    }

    public static function add(Shop $shop, $src) 
    {
        $arr = array(
            'shop' => $shop->id,
            'src' => $src);
        Pdb::insert($arr, self::table());
        return new self(Pdb::lastInsertId());
    }
}
