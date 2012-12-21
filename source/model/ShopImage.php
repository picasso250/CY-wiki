<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class ShopImage extends BasicModel
{
    public static $table = 'shop_image';

    public static function get(Shop $shop, $withSiteUrl = false)
    {
    	$conds = array('shop = ?' => $shop->id);
    	$arr = Pdb::fetchAll('src', self::table(), $conds);
    	// if ROOT is not /, will error
    	$siteUrl = 'http://' . $_SERVER['HTTP_HOST'];
    	if ($withSiteUrl) {
            return array_map(function ($src) use($siteUrl) {
                if (strpos($src, 'http') === 0) 
                    return $src;
                else 
                    return $siteUrl . $src;
            }, $arr);
    	} else {
    		return $arr;
    	}
    }

    public static function add(Shop $shop, $src)
    {
        Pdb::insert(array('shop' => $shop->id, 'src' => $src), self::$table);
    }
}
