<?php
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class TopClass extends BasicModel
{
    public static function add($name)
    {
        $className = get_called_class();
        Pdb::insert(
            compact('name'), 
            $className::table(), 
            'ON DUPLICATE KEY UPDATE name=name');
        return new $className(Pdb::lastInsertId());
    }

    // read as key value pairs
    public static function readArray()
    {
        $arr = static::read();
        $ret = array();
        foreach ($arr as $o) {
            $ret[$o->id] = $o->name;
        }
        return $ret;
    }

    public static function jsonData($conds = array())
    {
        $kind = get_called_class();
        $items = Pdb::fetchAll('*', $kind::table(), array(), array('`index` ASC'));
        $itemCount = count($items);
        $totalItems = $itemCount;
        return compact('kind', 'totalItems', 'itemCount', 'items');
    }

    public static function buildDbArgs($conds)
    {
        $tables = self::table();
        return array($tables, array(), array('`index` ASC'), '');
    }
}
